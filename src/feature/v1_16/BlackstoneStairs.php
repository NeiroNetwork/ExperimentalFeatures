<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Stair;
use pocketmine\item\ToolTier;

class BlackstoneStairs extends Feature implements IBlock{

	public function stringId() : string{
		return "blackstone_stairs";
	}

	public function block() : Block{
		return new Stair(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		);
	}
}
