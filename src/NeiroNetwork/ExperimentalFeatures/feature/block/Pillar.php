<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\block\Opaque;
use pocketmine\block\utils\PillarRotationInMetadataTrait;

class Pillar extends Opaque{
	use PillarRotationInMetadataTrait;

	protected function getAxisMetaShift() : int{
		return 0;
	}
}