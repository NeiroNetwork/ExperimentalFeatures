<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use ArrayObject;
use Closure;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\FeaturesList;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\register\hack\PmmpHacks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\block\UnknownBlock;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\StringToItemParser;
use pocketmine\Server;

class NewFeatureRegister{

	private static bool $initialized = false;

	public static function registerAll() : void{
		if(!self::$initialized){
			self::$initialized = true;

			$hacks = new PmmpHacks();
			$creativeItems = new ArrayObject();
			array_map(fn($feature) => self::register($feature, $hacks, $creativeItems), FeaturesList::get());
			array_map(fn(Item $item) => CreativeInventory::getInstance()->add($item), (array) $creativeItems);
			self::fixRecipes();
		}
	}

	private static function register(Feature $feature, PmmpHacks $hacks, ArrayObject $creativeItems) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			ExperimentalBlocks::register($feature->stringId(), BlockFactory::getInstance()->get($feature->blockId()->getBlockId(), 0));
			StringToItemParser::getInstance()->registerBlock($feature->stringId(), Closure::fromCallable([ExperimentalBlocks::class, "fromString"]));
			$hacks->runtimeBlockMapping->hack($feature->fullStringId(), ExperimentalBlocks::fromString($feature->stringId()));

			if(!$feature->isRegisteredPmmp()){
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), ExperimentalBlocks::fromString($feature->stringId())));
				$hacks->legacyBlockIdToStringIdMap->hack($feature->fullStringId(), $feature->blockId()->getBlockId());
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());
				if(!$feature instanceof IBlockOnly){
					// Minecraftの挙動的にはStringToItemParserもここに入れるべきだが、クリエイティブインベントリに追加しないだけにしておく
					$creativeItems->append(ExperimentalBlocks::fromString($feature->stringId())->asItem());
				}
			}
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			ExperimentalItems::register($feature->stringId(), ItemFactory::getInstance()->get($feature->itemId()->getId()));
			StringToItemParser::getInstance()->register($feature->stringId(), Closure::fromCallable([ExperimentalItems::class, "fromString"]));
			if(!$feature->isRegisteredPmmp()){
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());
				$creativeItems->append(ExperimentalItems::fromString($feature->stringId()));
			}
		}
	}

	/**
	 * 追加されてないアイテムをクラフトできるバグを修正する
	 */
	private static function fixRecipes() : void{
		$craftingManager = Server::getInstance()->getCraftingManager();
		$reflectedShapedRecipes = (new \ReflectionClass($craftingManager))->getProperty("shapedRecipes");
		$reflectedShapedRecipes->setAccessible(true);
		$reflectedShapelessRecipes = (new \ReflectionClass($craftingManager))->getProperty("shapelessRecipes");
		$reflectedShapelessRecipes->setAccessible(true);

		foreach($shapedRecipesValue = $craftingManager->getShapedRecipes() as $hash => $shapedRecipes){
			foreach($shapedRecipes as $key => $shapedRecipe){
				foreach($shapedRecipe->getResults() as $item){
					if($item instanceof ItemBlock && $item->getBlock() instanceof UnknownBlock){
						unset($shapedRecipesValue[$hash][$key]);
					}
				}
			}
		}
		$reflectedShapedRecipes->setValue($craftingManager, $shapedRecipesValue);

		foreach($shapelessRecipesValue = $craftingManager->getShapelessRecipes() as $hash => $shapelessRecipes){
			foreach($shapelessRecipes as $key => $shapelessRecipe){
				foreach($shapelessRecipe->getResults() as $item){
					if($item instanceof ItemBlock && $item->getBlock() instanceof UnknownBlock){
						unset($shapelessRecipesValue[$hash][$key]);
					}
				}
			}
		}
		$reflectedShapelessRecipes->setValue($craftingManager, $shapelessRecipesValue);
	}
}