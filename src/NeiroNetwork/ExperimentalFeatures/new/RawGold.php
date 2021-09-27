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
use pocketmine\item\ItemIdentifier;
use pocketmine\item\VanillaItems;

class RawGold implements IItem, Smeltable, Smeltable2, Craftable{

	public function recipe() : CraftingRecipe{
		return new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_GOLD()], [ExperimentalBlocks::RAW_GOLD_BLOCK()->asItem()]);
	}

	public function internalId() : int{
		return 601;
	}

	public function networkId() : int{
		return 506;
	}

	public function name() : string{
		return "raw_gold";
	}

	public function item() : Item{
		return new Item(new ItemIdentifier($this->internalId(), 0), "Raw Gold");
	}

	public function furnace() : FurnaceRecipe{
		return new FurnaceRecipe(VanillaItems::GOLD_INGOT(), ExperimentalItems::RAW_GOLD());
	}
}