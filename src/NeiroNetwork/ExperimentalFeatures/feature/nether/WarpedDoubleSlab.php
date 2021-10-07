<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\nether;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Planks;
use pocketmine\item\Item;

class WarpedDoubleSlab extends Feature implements IBlock{

	public function networkId() : int{
		return -267;
	}

	public function name() : string{
		return "warped_double_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Warped Double Slab", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0)
		) extends Planks{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalBlocks::WARPED_SLAB()->asItem()->setCount(2)];
			}
		};
	}
}