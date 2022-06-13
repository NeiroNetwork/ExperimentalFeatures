<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\block\DoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class ExposedDoubleCutCopperSlab extends Feature implements IBlock{

	public function stringId() : string{
		return "exposed_double_cut_copper_slab";
	}

	public function block() : Block{
		return new DoubleSlab(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		);
	}
}
