<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

use pocketmine\block\utils\PillarRotationInMetadataTrait;

class SimpleLog extends SimpleWood{
	use PillarRotationInMetadataTrait;

	protected function getAxisMetaShift() : int{
		return 0;
	}
}