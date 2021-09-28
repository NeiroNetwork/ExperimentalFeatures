<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\base\BaseAmethystBud;
use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
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