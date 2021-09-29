<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RawGold extends Feature implements IItem, Smeltable, Smeltable2, HasRecipe{

	public function recipe() : array{
		return [
			new FurnaceRecipe(VanillaItems::GOLD_INGOT(), ExperimentalItems::RAW_GOLD()),
			new ShapelessRecipe([ExperimentalBlocks::RAW_GOLD_BLOCK()->asItem()], [ExperimentalItems::RAW_GOLD()->setCount(9)])
		];
	}

	public function networkId() : int{
		return 506;
	}

	public function name() : string{
		return "raw_gold";
	}

	public function item() : Item{
		return new Item($this->itemId(), "Raw Gold");
	}
}