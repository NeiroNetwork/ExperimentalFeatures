<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\block\Roots;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;

class WarpedRoots extends Feature implements IBlock{

	public function stringId() : string{
		return "warped_roots";
	}

	public function block() : Block{
		return new Roots($this->blockId(), $this->displayName(), BlockBreakInfo::instant());
	}
}
