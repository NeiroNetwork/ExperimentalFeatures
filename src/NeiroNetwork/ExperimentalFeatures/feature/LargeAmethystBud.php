<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\base\BaseAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;

class LargeAmethystBud extends Feature implements IBlock{

	public function networkId() : int{
		return -330;
	}

	public function name() : string{
		return "large_amethyst_bud";
	}

	public function block() : Block{
		return new class($this->blockId(), "Large Amethyst Bud") extends BaseAmethystBud{
			// TODO: recalculateCollisionBoxes()
		};
	}
}