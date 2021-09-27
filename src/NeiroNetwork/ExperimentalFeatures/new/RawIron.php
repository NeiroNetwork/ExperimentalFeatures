<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\VanillaItems;

class RawIron implements IItem, Smeltable, Smeltable2{

	public function internalId() : int{
		return 600;
	}

	public function networkId() : int{
		return 505;
	}

	public function name() : string{
		return "raw_iron";
	}

	public function item() : Item{
		return new Item(new ItemIdentifier($this->internalId(), 0), "Raw Iron");
	}

	public function furnace() : FurnaceRecipe{
		return new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::fromString($this->name()));
	}
}