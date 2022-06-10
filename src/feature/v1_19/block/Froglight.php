<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19\block;

use NeiroNetwork\ExperimentalFeatures\feature\block\Pillar;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;

class Froglight extends Pillar{

	public function __construct(BlockIdentifier $idInfo, string $name){
		parent::__construct($idInfo, $name, new BlockBreakInfo(0.3));
	}

	public function isTransparent() : bool{
		return true;
	}

	public function getLightLevel() : int{
		return 15;
	}
}