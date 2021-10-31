<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_11\block\BaseCampfire;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class BeeNest extends Feature implements IBlock{

	public function stringId() : string{
		return "bee_nest";
	}

	public function block() : Block{
		return new BaseCampfire(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.3, BlockToolType::AXE, ToolTier::WOOD()->getHarvestLevel())
		);
	}
}