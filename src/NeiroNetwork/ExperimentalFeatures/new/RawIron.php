<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\Craftable;
use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\crafting\CraftingRecipe;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RawIron extends Feature implements IItem, Smeltable, Smeltable2, Craftable{

	public function recipe() : CraftingRecipe{
		return new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_IRON()], [ExperimentalBlocks::RAW_IRON_BLOCK()->asItem()]);
	}

	public function networkId() : int{
		return 505;
	}

	public function name() : string{
		return "raw_iron";
	}

	public function item() : Item{
		return new Item($this->itemId(), "Raw Iron");
	}

	public function furnace() : FurnaceRecipe{
		return new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::RAW_IRON());
	}
}