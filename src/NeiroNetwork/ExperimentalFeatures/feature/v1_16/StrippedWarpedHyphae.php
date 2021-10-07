<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\base\SimpleLog;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class StrippedWarpedHyphae extends Feature implements IBlock{

	public function networkId() : int{
		return -301;
	}

	public function name() : string{
		return "stripped_warped_hyphae";
	}

	public function block() : Block{
		return new SimpleLog($this->blockId(), "Stripped Warped Hyphae", new BlockBreakInfo(2.0, BlockToolType::AXE));
	}
}