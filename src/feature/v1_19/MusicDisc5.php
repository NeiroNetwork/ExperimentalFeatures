<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;

class MusicDisc5 extends Feature implements IItem{

	public function stringId() : string{
		return "music_disc_5";
	}

	public function item() : Item{
		return new class($this->itemId(), $this->displayName()) extends Item{
			public function getMaxStackSize() : int{ return 1; }
		};
	}
}
