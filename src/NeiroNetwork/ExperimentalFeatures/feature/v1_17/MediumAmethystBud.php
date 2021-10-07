<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\base\BaseAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;

class MediumAmethystBud extends Feature implements IBlock{

	public function networkId() : int{
		return -331;
	}

	public function name() : string{
		return "medium_amethyst_bud";
	}

	public function block() : Block{
		return new class($this->blockId(), "Medium Amethyst Bud") extends BaseAmethystBud{
			// TODO: recalculateCollisionBoxes()
		};
	}
}