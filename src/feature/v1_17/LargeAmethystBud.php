<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\block\AmethystBud;
use pocketmine\block\Block;

class LargeAmethystBud extends Feature implements IBlock{

	public function stringId() : string{
		return "large_amethyst_bud";
	}

	public function block() : Block{
		return new class($this->blockId(), $this->displayName()) extends AmethystBud{
			public function getLightLevel() : int{ return 4; }
			public function getWidthHeight() : array{ return [10, 5]; }
		};
	}
}
