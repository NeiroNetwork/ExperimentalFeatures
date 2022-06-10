<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\block\Sapling;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;

class FloweringAzalea extends Feature implements IBlock{

	public function stringId() : string{
		return "flowering_azalea";
	}

	public function block() : Block{
		return new Sapling($this->blockId(), $this->displayName(), BlockBreakInfo::instant());
	}
}