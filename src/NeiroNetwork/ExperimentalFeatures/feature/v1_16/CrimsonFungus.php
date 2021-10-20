<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Opaque;

class CrimsonFungus extends Feature implements IBlock{

	public function stringId() : string{
		return "crimson_fungus";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0)
		);
	}
}