<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class AmethystShard extends Feature implements IItem{

	public function networkId() : int{
		return 624;
	}

	public function name() : string{
		return "amethyst_shard";
	}

	public function item() : Item{
		return new Item(new ItemIdentifier($this->internalId(), 0), "Amethyst Shard");
	}
}