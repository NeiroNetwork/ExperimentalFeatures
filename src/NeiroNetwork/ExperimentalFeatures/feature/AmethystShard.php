<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\interface\IItem;
use pocketmine\item\Item;

class AmethystShard extends Feature implements IItem{

	public function networkId() : int{
		return 623;
	}

	public function name() : string{
		return "amethyst_shard";
	}

	public function item() : Item{
		return new Item($this->itemId(), "Amethyst Shard");
	}
}