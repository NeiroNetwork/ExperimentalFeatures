<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\crafting\CraftingRecipe;

interface Craftable{

	public function recipe() : CraftingRecipe;
}