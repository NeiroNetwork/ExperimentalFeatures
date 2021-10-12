<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use Closure;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\FeaturesList;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\recipe\BlastFurnaceRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\recipe\SmokerRecipe;
use NeiroNetwork\ExperimentalFeatures\register\hack\BlockMappingHack;
use NeiroNetwork\ExperimentalFeatures\register\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\StringToItemParser;
use pocketmine\Server;

class NewFeatureRegister{

	private static bool $initialized = false;

	public static function registerAll() : void{
		if(!self::$initialized){
			self::$initialized = true;

			$hack1 = new BlockMappingHack();
			$hack2 = new ItemTranslatorHack();
			array_map(fn($feature) => self::register($feature, $hack1, $hack2), FeaturesList::get());
		}
	}

	private static function register(Feature $feature, BlockMappingHack $hack1, ItemTranslatorHack $hack2) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			ExperimentalBlocks::register($feature->stringId(), BlockFactory::getInstance()->get($feature->blockId()->getBlockId(), 0));
			StringToItemParser::getInstance()->registerBlock($feature->stringId(), Closure::fromCallable([ExperimentalBlocks::class, "fromString"]));
			$hack1->hack($feature->fullStringId(), ExperimentalBlocks::fromString($feature->stringId()));

			if(!$feature->isRegisteredPmmp()){
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), ExperimentalBlocks::fromString($feature->stringId())));
				$hack2->hack($feature->itemId()->getId(), $feature->runtimeId());
				if($feature instanceof IBlockOnly){
					// Minecraftの挙動的にはStringToItemParserもここに入れるべきだが、クリエイティブインベントリに追加しないだけにしておく
					CreativeInventory::getInstance()->add(ExperimentalBlocks::fromString($feature->stringId())->asItem());
				}
			}
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			ExperimentalItems::register($feature->stringId(), ItemFactory::getInstance()->get($feature->itemId()->getId()));
			StringToItemParser::getInstance()->register($feature->stringId(), Closure::fromCallable([ExperimentalItems::class, "fromString"]));
			if(!$feature->isRegisteredPmmp()){
				$hack2->hack($feature->itemId()->getId(), $feature->runtimeId());
				CreativeInventory::getInstance()->add(ExperimentalItems::fromString($feature->stringId()));
			}
		}
	}

	private static function register2(Feature $feature) : void{
		$craftingManager = Server::getInstance()->getCraftingManager();
		if($feature instanceof HasRecipe){
			foreach($feature->recipe() as $recipe){
				match(true){
					$recipe instanceof ShapedRecipe => $craftingManager->registerShapedRecipe($recipe),
					$recipe instanceof ShapelessRecipe => $craftingManager->registerShapelessRecipe($recipe),
					$recipe instanceof FurnaceRecipe => $craftingManager->getFurnaceRecipeManager(FurnaceType::FURNACE())->register($recipe),
					$recipe instanceof BlastFurnaceRecipe => $craftingManager->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE())->register($recipe),
					$recipe instanceof SmokerRecipe => $craftingManager->getFurnaceRecipeManager(FurnaceType::SMOKER())->register($recipe),
				};
			}
		}
	}
}