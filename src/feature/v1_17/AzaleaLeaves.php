<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\block\Leaves;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class AzaleaLeaves extends Feature implements IBlock{

	public function stringId() : string{
		return "azalea_leaves";
	}

	public function block() : Block{
		return new Leaves($this->blockId(), $this->displayName(), VanillaBlocks::azalea()->asItem());
	}
}