<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\block\DoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class MudBrickDoubleSlab extends Feature implements IBlock{

	public function stringId() : string{
		return "mud_brick_double_slab";
	}

	public function block() : Block{
		return new DoubleSlab(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 15.0)
		);
	}
}
