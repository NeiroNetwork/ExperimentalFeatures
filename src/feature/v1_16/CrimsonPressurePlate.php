<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenPressurePlate;

class CrimsonPressurePlate extends Feature implements IBlock{

	public function stringId() : string{
		return "crimson_pressure_plate";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.5, BlockToolType::AXE)
		) extends WoodenPressurePlate{
			public function getFuelTime() : int{
				return 0;
			}
		};
	}
}
