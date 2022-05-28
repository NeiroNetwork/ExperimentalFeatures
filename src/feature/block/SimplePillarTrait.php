<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\block\utils\PillarRotationInMetadataTrait;

trait SimplePillarTrait{
	use PillarRotationInMetadataTrait;

	protected function getAxisMetaShift() : int{
		return 0;
	}
}