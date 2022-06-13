<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;

class MangroveBoat extends Feature implements IItem{

	public function stringId() : string{
		return "mangrove_boat";
	}

	public function item() : Item{
		return new class($this->itemId(), $this->displayName()) extends Item{
			public function getFuelTime() : int{
				return 1200;
			}

			public function getMaxStackSize() : int{
				return 1;
			}
		};
	}
}
