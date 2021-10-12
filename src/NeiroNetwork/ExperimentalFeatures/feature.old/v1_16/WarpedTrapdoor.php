<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenTrapdoor;

class WarpedTrapdoor extends Feature implements IBlock{

	public function networkId() : int{
		return -247;
	}

	public function name() : string{
		return "warped_trapdoor";
	}

	public function block() : Block{
		return new WoodenTrapdoor($this->blockId(), "Warped Trapdoor", new BlockBreakInfo(3.0, BlockToolType::AXE, 0, 15.0));
	}
}