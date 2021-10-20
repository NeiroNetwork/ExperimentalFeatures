<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_11;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\item\ToolTier;

class Campfire extends Feature implements IBlock{

	public function stringId() : string{
		return "campfire";
	}

	public function block() : Block{
		return new Transparent(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(2.0, BlockToolType::AXE, ToolTier::WOOD()->getHarvestLevel())
		);
	}
}