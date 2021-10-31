<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Food;
use pocketmine\item\Item;

class HoneyBottle extends Feature implements IItem{

	public function stringId() : string{
		return "honey_bottle";
	}

	public function item() : Item{
		return new class ($this->itemId(), $this->displayName()) extends Food{
			public function getFoodRestore() : int{
				return 6;
			}

			public function getSaturationRestore() : float{
				return 16.8;
			}
		} ;
	}
}