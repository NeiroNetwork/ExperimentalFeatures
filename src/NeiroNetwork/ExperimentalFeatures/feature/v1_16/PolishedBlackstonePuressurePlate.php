<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenPressurePlate;

class PolishedBlackstonePuressurePlate extends Feature implements IBlock{

	public function networkId() : int{
		return -295;
	}

	public function name() : string{
		return "polished_blackstone_pressure_plate";
	}

	public function block() : Block{
		return new WoodenPressurePlate($this->blockId(), "Polished Blackstone Pressure Plate", new BlockBreakInfo(0.5, BlockToolType::PICKAXE));
	}
}{

}