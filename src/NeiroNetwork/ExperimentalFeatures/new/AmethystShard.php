<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use pocketmine\item\Item;

class AmethystShard extends Feature implements IItem{

	public function networkId() : int{
		return 624;
	}

	public function name() : string{
		return "amethyst_shard";
	}

	public function item() : Item{
		return new Item($this->itemId(), "Amethyst Shard");
	}
}