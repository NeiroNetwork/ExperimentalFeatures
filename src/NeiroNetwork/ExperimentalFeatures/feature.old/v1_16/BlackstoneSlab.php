<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\base\Slab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class BlackstoneSlab extends Feature implements IBlock{

	public function networkId() : int{
		return -282;
	}

	public function name() : string{
		return "blackstone_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Blackstone Slab", new BlockBreakInfo(2.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		) extends Slab{
			public function getDoubleSlab() : Block{
				return ExperimentalBlocks::BLACKSTONE_DOUBLE_SLAB();
			}
		};
	}
}