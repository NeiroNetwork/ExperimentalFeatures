<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;

class RawGold extends Feature implements IItem{

	public function stringId() : string{
		return "raw_gold";
	}

	public function item() : Item{
		return new Item($this->itemId(), $this->displayName());
	}
}
