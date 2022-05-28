<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\FenceGate;

class CrimsonFenceGate extends Feature implements IBlock{

	public function stringId() : string{
		return "crimson_fence_gate";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0)
		) extends FenceGate{
			// ネザーの木材は燃えない
			public function getFuelTime() : int{ return 0; }
			public function getFlameEncouragement() : int{ return 0; }
			public function getFlammability() : int{ return 0; }
		};
	}
}