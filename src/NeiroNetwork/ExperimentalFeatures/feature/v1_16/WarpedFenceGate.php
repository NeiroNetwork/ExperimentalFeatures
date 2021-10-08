<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\FenceGate;

class WarpedFenceGate extends Feature implements IBlock{

	public function networkId() : int{
		return -259;
	}

	public function name() : string{
		return "warped_fence_gate";
	}

	public function block() : Block{
		return new FenceGate($this->blockId(), "Warped Fence Gate", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0));
	}
}