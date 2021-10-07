<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\base\SimpleWoodenSlab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class WarpedSlab extends Feature implements IBlock{

	public function networkId() : int{
		return -265;
	}

	public function name() : string{
		return "warped_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Warped Slab", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0)
		) extends SimpleWoodenSlab{
			public function getDoubleSlab() : Block{
				return ExperimentalBlocks::WARPED_DOUBLE_SLAB();
			}
		};
	}
}