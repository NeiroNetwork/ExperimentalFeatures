<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

class WoodenSlab extends Slab{

	public function getFuelTime() : int{
		return 300;
	}

	public function getFlameEncouragement() : int{
		return 5;
	}

	public function getFlammability() : int{
		return 20;
	}
}