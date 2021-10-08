<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenButton;

class CrimsonButton extends Feature implements IBlock{

	public function networkId() : int{
		return -260;
	}

	public function name() : string{
		return "crimson_button";
	}

	public function block() : Block{
		return new WoodenButton($this->blockId(), "Crimson Button", new BlockBreakInfo(0.5, BlockToolType::AXE));
	}
}