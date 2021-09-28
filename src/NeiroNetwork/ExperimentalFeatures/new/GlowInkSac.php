<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class GlowInkSac implements IItem{

	public function internalId() : int{
		return 602;
	}

	public function networkId() : int{
		return 503;
	}

	public function name() : string{
		return "glow_ink_sac";
	}

	public function item() : Item{
		return new Item(new ItemIdentifier($this->internalId(), 0), "Glow Ink Sac");
	}
}