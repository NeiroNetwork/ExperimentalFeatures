<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use NeiroNetwork\ExperimentalFeatures\override\expert\assets\TileItemFrame;
use NeiroNetwork\ExperimentalFeatures\override\expert\assets\TileSign;
use pocketmine\block\BaseSign;
use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\ItemFrame;
use pocketmine\block\tile\TileFactory;
use pocketmine\block\VanillaBlocks;

class TileBlocks extends BlockOverrideExpert{

	/**
	 * 額縁のアイテムを正しく表示させるようにする
	 */
	protected function item_frame() : Block{
		TileFactory::getInstance()->register(TileItemFrame::class, ["ItemFrame"]);

		$b = VanillaBlocks::ITEM_FRAME();
		$id = $b->getIdInfo();
		return new ItemFrame(new BlockIdentifier($id->getBlockId(), $id->getVariant(), $id->getItemId(), TileItemFrame::class), $b->getName(), $b->getBreakInfo());
	}

	/**
	 * 看板を光らせるようにする
	 */
	protected function signs() : array{
		TileFactory::getInstance()->register(TileSign::class, ["Sign", "minecraft:sign"]);

		$result = [];

		foreach(BlockFactory::getInstance()->getAllKnownStates() as $block){
			if($block instanceof BaseSign){
				$id = $block->getIdInfo();
				$newInfo = new BlockIdentifier($id->getBlockId(), $id->getVariant(), $id->getItemId(), TileSign::class);

				$property = (new \ReflectionClass($block))->getProperty("idInfo");
				$property->setAccessible(true);
				$property->setValue($block, $newInfo);

				$result[] = $block;
			}
		}

		return $result;
	}
}