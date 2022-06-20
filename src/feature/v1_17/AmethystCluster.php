<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\block\BaseAmethystCluster;
use pocketmine\block\Block;

class AmethystCluster extends Feature implements IBlock{

	public function stringId() : string{
		return "amethyst_cluster";
	}

	public function block() : Block{
		return new class($this->blockId(), $this->displayName()) extends BaseAmethystCluster{
			public function getLightLevel() : int{ return 5; }
			public function getWidthHeight() : array{ return [10, 7]; }
		};
	}
}
