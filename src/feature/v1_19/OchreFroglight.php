<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_19\block\Froglight;
use pocketmine\block\Block;

class OchreFroglight extends Feature implements IBlock{

	public function stringId() : string{
		return "ochre_froglight";
	}

	public function block() : Block{
		return new Froglight($this->blockId(), $this->displayName());
	}
}