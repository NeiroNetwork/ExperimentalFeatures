<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;

class DirtWithRoots extends Feature implements IBlock{

	public function stringId() : string{
		return "dirt_with_roots";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(),
			"Rooted Dirt",
			new BlockBreakInfo(0.5, BlockToolType::SHOVEL)
		);
	}
}