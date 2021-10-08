<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\base\BaseAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;

class SmallAmethystBud extends Feature implements IBlock{

	public function networkId() : int{
		return -332;
	}

	public function name() : string{
		return "small_amethyst_bud";
	}

	public function block() : Block{
		return new class($this->blockId(), "Small Amethyst Bud") extends BaseAmethystBud{
			// TODO: recalculateCollisionBoxes()
		};
	}
}