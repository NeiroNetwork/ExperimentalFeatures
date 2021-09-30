<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

class SimpleWoodenSlab extends SimpleSlab{

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