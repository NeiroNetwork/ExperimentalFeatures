<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\crafting\CraftingRecipe;
use pocketmine\crafting\FurnaceRecipe;

/**
 * そのアイテムを入手するためのレシピを提供する
 */
interface HasRecipe{

	/**
	 * @return CraftingRecipe[]|FurnaceRecipe[]
	 */
	public function recipe() : array;
}