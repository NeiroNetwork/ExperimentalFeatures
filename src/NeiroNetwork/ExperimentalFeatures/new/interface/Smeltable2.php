<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\crafting\FurnaceRecipe;

interface Smeltable2{

	public function furnace() : FurnaceRecipe;
}