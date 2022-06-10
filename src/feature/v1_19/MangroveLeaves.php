<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\block\Leaves;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\item\VanillaItems;

class MangroveLeaves extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_leaves";
	}

	public function block() : Block{
		return new Leaves($this->blockId(), $this->displayName(), VanillaItems::AIR());	// TODO: 苗木(アイテム)
	}
}