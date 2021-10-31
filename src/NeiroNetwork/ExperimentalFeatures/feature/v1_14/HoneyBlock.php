<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;

class HoneyBlock extends Feature implements IBlock{

	public function stringId() : string{
		return "honey_block";
	}

	public function block() : Block{
		return new Transparent(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		);
	}
}