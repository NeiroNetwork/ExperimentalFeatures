<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

use pocketmine\block\Opaque;

class SimpleWood extends Opaque{

	public function getFuelTime() : int{
		return 300;
	}

	public function getFlameEncouragement() : int{
		return 5;
	}

	public function getFlammability() : int{
		return 5;
	}
}