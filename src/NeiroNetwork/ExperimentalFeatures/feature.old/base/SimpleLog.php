<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

use pocketmine\block\Opaque;
use pocketmine\block\utils\PillarRotationInMetadataTrait;

class SimpleLog extends Opaque{
	use PillarRotationInMetadataTrait;

	public function getFuelTime() : int{
		return 300;
	}

	public function getFlameEncouragement() : int{
		return 5;
	}

	public function getFlammability() : int{
		return 5;
	}

	protected function getAxisMetaShift() : int{
		return 0;
	}
}