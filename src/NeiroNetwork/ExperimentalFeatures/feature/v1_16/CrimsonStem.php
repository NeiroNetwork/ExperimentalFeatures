<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\block\WoodenPillar;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class CrimsonStem extends Feature implements IBlock{

	function stringId() : string{
		return "crimson_stem";
	}

	public function block() : Block{
		return new WoodenPillar(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(2.0, BlockToolType::AXE)
		);
	}
}