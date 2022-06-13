<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;
use pocketmine\item\Releasable;
use pocketmine\player\Player;

class Spyglass extends Feature implements IItem{

	public function stringId() : string{
		return "spyglass";
	}

	public function item() : Item{
		return new class($this->itemId(), $this->displayName()) extends Item implements Releasable{
			public function getMaxStackSize() : int{
				return 1;
			}
			public function canStartUsingItem(Player $player) : bool{
				return true;
			}
		};
	}
}
