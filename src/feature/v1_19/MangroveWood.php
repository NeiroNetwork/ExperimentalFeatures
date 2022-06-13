<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\block\Log;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class MangroveWood extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_wood";
	}

	public function block() : Block{
		// FIXME: なんか向きがおかしい
		return new Log(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(2.0, BlockToolType::AXE)
		);
	}
}
