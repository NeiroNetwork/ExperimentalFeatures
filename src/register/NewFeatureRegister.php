<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\helper\PhpClassesEnumerater;
use NeiroNetwork\ExperimentalFeatures\register\hack\PmmpHacks;
use pocketmine\block\BlockFactory;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;

class NewFeatureRegister{

	public static function registerAll() : void{
		$list = PhpClassesEnumerater::list("feature", Feature::class);
		shuffle($list);

		$hacks = new PmmpHacks();
		array_map(fn(string $class) => self::register(new $class, $hacks), $list);
	}

	private static function register(Feature $feature, PmmpHacks $hacks) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			$hacks->vanillaBlocksHack->register($feature->stringId(), clone $feature->block());
			StringToItemParser::getInstance()->registerBlock($feature->stringId(), fn() => forward_static_call([VanillaBlocks::class, $feature->stringId()]));
			$blocks = $hacks->runtimeBlockMapping->hack($feature->fullStringId(), clone $feature->block());

			LegacyStringToItemParser::getInstance()->addMapping($feature->stringId(), $feature->itemId()->getId());
			LegacyStringToItemParser::getInstance()->addMapping((string) $feature->itemId()->getId(), $feature->itemId()->getId());
			$hacks->blameLegacyStringToItemParser->registerBlock($feature);

			if(!$feature->isRegisteredPmmp()){
				$hacks->legacyBlockIdToStringIdMap->hack($feature->fullStringId(), $feature->blockId()->getBlockId());
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());

				// (今の仕様だと)PocketMine-MPに登録されていないアイテムが256未満になることはないので、ItemBlockを登録してあげる必要がある
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), clone $feature->block()));
				foreach($blocks as $block){
					ItemFactory::getInstance()->register(new ItemBlock(new ItemIdentifier($feature->itemId()->getId(), $block->getMeta()), $block));
				}
			}

			// ItemBlockのIDは256未満 というルールを破ったアイテムが一部存在するため、そういう場合はItemBlockを登録してあげる
			if(ItemFactory::getInstance()->get($feature->itemId()->getId(), $feature->itemId()->getMeta())->getName() === "Unknown"){
				ItemFactory::getInstance()->register(new ItemBlock($feature->itemId(), clone $feature->block()));
			}
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			$hacks->vanillaItemsHack->register($feature->stringId(), clone $feature->item());
			StringToItemParser::getInstance()->register($feature->stringId(), fn() => forward_static_call([VanillaItems::class, $feature->stringId()]));
			LegacyStringToItemParser::getInstance()->addMapping($feature->stringId(), $feature->itemId()->getId());
			LegacyStringToItemParser::getInstance()->addMapping((string) $feature->itemId()->getId(), $feature->itemId()->getId());
			if(!$feature->isRegisteredPmmp()){
				$hacks->legacyItemIdToStringIdMap->hack($feature->fullStringId(), $feature->itemId()->getId());
				$hacks->itemTranslator->hack($feature->itemId()->getId(), $feature->runtimeId());
			}
		}
	}
}