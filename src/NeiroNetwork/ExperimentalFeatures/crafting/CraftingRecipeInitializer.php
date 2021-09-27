<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\crafting;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\item\VanillaItems;
use pocketmine\Server;

class CraftingRecipeInitializer{

	public static function init() : void{
		self::craftingTable();
		self::furnace();
		self::blastFurnace();
	}

	private static function craftingTable() : void{
		$manager = Server::getInstance()->getCraftingManager();
		$manager->registerShapedRecipe(new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_IRON()], [ExperimentalBlocks::RAW_IRON()->asItem()]));
		$manager->registerShapedRecipe(new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_GOLD()], [ExperimentalBlocks::RAW_GOLD()->asItem()]));
		$manager->registerShapelessRecipe(new ShapelessRecipe([ExperimentalBlocks::RAW_IRON()->asItem()], [ExperimentalItems::RAW_IRON()->setCount(9)]));
		$manager->registerShapelessRecipe(new ShapelessRecipe([ExperimentalBlocks::RAW_GOLD()->asItem()], [ExperimentalItems::RAW_GOLD()->setCount(9)]));
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