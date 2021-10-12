<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\recipe\BlastFurnaceRecipe;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RawIron extends Feature implements IItem, HasRecipe{

	function stringId() : string{
		return "raw_iron";
	}

	public function item() : Item{
		return new Item($this->itemId(), $this->displayName());
	}

	public function recipe() : array{
		return [
			new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::fromString("raw_iron")),
			new BlastFurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::fromString("raw_iron")),
			new ShapelessRecipe(
				[ExperimentalBlocks::fromString("raw_iron_block")->asItem()],
				[ExperimentalItems::fromString("raw_iron")->setCount(9)]
			)
		];
	}
}