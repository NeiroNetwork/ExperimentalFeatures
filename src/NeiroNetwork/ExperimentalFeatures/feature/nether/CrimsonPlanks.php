<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\nether;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Planks;

class CrimsonPlanks extends Feature implements IBlock{

	public function networkId() : int{
		return -242;
	}

	public function name() : string{
		return "crimson_planks";
	}

	public function block() : Block{
		return new Planks($this->blockId(), "Crimson Planks", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0));
	}
}