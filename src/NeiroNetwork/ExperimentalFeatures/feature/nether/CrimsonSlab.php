<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\nether;

use NeiroNetwork\ExperimentalFeatures\feature\base\SimpleWoodenSlab;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class CrimsonSlab extends Feature implements IBlock{

	public function networkId() : int{
		return -264;
	}

	public function name() : string{
		return "crimson_slab";
	}

	public function block() : Block{
		return new SimpleWoodenSlab($this->blockId(), "Crimson Slab", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0));
	}
}