<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\block\Sapling;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;

class MangrovePropagule extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_propagule";
	}

	public function block() : Block{
		return new Sapling($this->blockId(), $this->displayName(), BlockBreakInfo::instant());
	}
}