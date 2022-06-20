<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;

class RecoveryCompass extends Feature implements IItem{

	public function stringId() : string{
		return "recovery_compass";
	}

	public function item() : Item{
		return new Item($this->itemId(), $this->displayName());
	}
}
