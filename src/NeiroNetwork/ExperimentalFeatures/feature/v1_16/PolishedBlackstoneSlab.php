<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\base\SimpleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class PolishedBlackstoneSlab extends Feature implements IBlock{

	public function networkId() : int{
		return -293;
	}

	public function name() : string{
		return "polished_blackstone_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Polished Blackstone Slab", new BlockBreakInfo(2.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		) extends SimpleSlab{
			public function getDoubleSlab() : Block{
				return ExperimentalBlocks::POLISHED_BLACKSTONE_DOUBLE_SLAB();
			}
		};
	}
}{

}