<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Opaque;
use pocketmine\block\Rail;

class WarpedFungus extends Feature implements IBlock{

	public function stringId() : string{
		return "warped_fungus";
	}

	public function block() : Block{
		return new Rail(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0)
		);
	}
}