<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenTrapdoor;

class MangroveTrapdoor extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_trapdoor";
	}

	public function block() : Block{
		return new WoodenTrapdoor(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::AXE)
		);
	}
}
