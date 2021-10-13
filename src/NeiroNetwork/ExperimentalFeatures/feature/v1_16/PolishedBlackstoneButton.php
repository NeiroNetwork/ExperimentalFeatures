<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\block\Button;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;

class PolishedBlackstoneButton extends Feature implements IBlock{

	public function stringId() : string{
		return "polished_blackstone_button";
	}

	public function block() : Block{
		return new Button(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.5,)
		);
	}
}


