<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\StonePressurePlate;
use pocketmine\item\ToolTier;

class PolishedBlackstonePressurePlate extends Feature implements IBlock{

	public function stringId() : string{
		return "polished_blackstone_pressure_plate";
	}

	public function block() : Block{
		return new StonePressurePlate(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())
		);
	}
}

