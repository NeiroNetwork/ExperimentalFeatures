<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\FeaturesList;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\register\hack\PmmpHacks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\StringToItemParser;

class NewFeatureRegister{

	private static bool $initialized = false;

	public static function registerAll() : void{
		if(!self::$initialized){
			self::$initialized = true;

			$hacks = new PmmpHacks();
			$creativeFeatures = new \ArrayObject();
			array_map(fn($feature) => self::register($feature, $hacks, $creativeFeatures), FeaturesList::get());
			//array_map(fn(Item $item) => CreativeInventory::getInstance()->add($item), (array) $creativeItems);
		}
	}

	private static function register(Feature $feature, PmmpHacks $hacks, \ArrayObject $creativeFeatures) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			ExperimentalBlocks::register($feature->stringId(), BlockFactory::getInstance()->get($feature->blockId()->getBlockId(), 0));
			StringToItemParser::getInstance()->registerBlock($feature->stringId(), \Closure::fromCallable([ExperimentalBlocks::class, "fromString"]));
			LegacyStringToItemParser::getInstance()->addMapping($feature->stringId(), $feature->itemId()->getId());
			LegacyStringToItemParser::getInstance()->addMapping((string) $feature->itemId()->getId(), $feature->itemId()->getId());
			$hacks->runtimeBlockMapping->hack($feature->fullStringId(), ExperimentalBlocks::fromString($feature->stringId()));

			if(!$feature->isRegisteredPmmp()){
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), ExperimentalBlocks::fromString($feature->stringId())));
				$hacks->legacyBlockIdToStringIdMap->hack($feature->fullStringId(), $feature->blockId()->getBlockId());
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());
				if(!$feature instanceof IBlockOnly){
					// Minecraftの挙動的にはStringToItemParserもここに入れるべきだが、クリエイティブインベントリに追加しないだけにしておく
					$creativeFeatures->append($feature);
				}
			}

			if(ItemFactory::getInstance()->get($feature->itemId()->getId(), $feature->itemId()->getMeta())->getName() === "Unknown"){
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), ExperimentalBlocks::fromString($feature->stringId())));
			}
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			ExperimentalItems::register($feature->stringId(), ItemFactory::getInstance()->get($feature->itemId()->getId()));
			StringToItemParser::getInstance()->register($feature->stringId(), \Closure::fromCallable([ExperimentalItems::class, "fromString"]));
			LegacyStringToItemParser::getInstance()->addMapping($feature->stringId(), $feature->itemId()->getId());
			LegacyStringToItemParser::getInstance()->addMapping((string) $feature->itemId()->getId(), $feature->itemId()->getId());
			if(!$feature->isRegisteredPmmp()){
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());
				$creativeItems->append(ExperimentalItems::fromString($feature->stringId()));
			}
		}
	}
}