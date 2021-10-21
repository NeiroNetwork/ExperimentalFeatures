<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\block\Pillar;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;

class GildedBlackstone extends Feature implements IBlock{

	public function stringId() : string{
		return "gilded_blackstone";
	}
	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return
				 [VanillaItems::GOLD_NUGGET()->setCount(mt_rand(2,5))];
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}