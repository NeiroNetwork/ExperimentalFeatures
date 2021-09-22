<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\crafting;

use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\item\VanillaItems;
use pocketmine\Server;

class CraftingRecipeInitializer{

	public static function init() : void{
		self::craftingTable();
		self::furnace();
		self::blastFurnace();
	}

	private static function craftingTable() : void{
	}

	private static function furnace() : void{
		$manager = Server::getInstance()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::FURNACE());
		$manager->register(new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::RAW_IRON()));
		$manager->register(new FurnaceRecipe(VanillaItems::GOLD_INGOT(), ExperimentalItems::RAW_GOLD()));
	}

	private static function blastFurnace() : void{
		$manager = Server::getInstance()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE());
		$manager->register(new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::RAW_IRON()));
		$manager->register(new FurnaceRecipe(VanillaItems::GOLD_INGOT(), ExperimentalItems::RAW_GOLD()));
	}
}