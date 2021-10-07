<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenFence;

class CrimsonFence extends Feature implements IBlock{

	public function networkId() : int{
		return -256;
	}

	public function name() : string{
		return "crimson_fence";
	}

	public function block() : Block{
		return new WoodenFence($this->blockId(), "Crimson Fence", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0));
	}
}