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
		// FIXME: 本来は燃えないが ButtonsAndPressurePlates との関係でWoodenPressurePlateかStonePressurePlateしか選択できずクラスの拡張も出来ない
		return new WoodenPressurePlate(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.5, BlockToolType::AXE)
		);
	}
}