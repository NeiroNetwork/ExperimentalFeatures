<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\crafting\FurnaceRecipe;

interface Smeltable{

	public function furnace() : FurnaceRecipe;
}