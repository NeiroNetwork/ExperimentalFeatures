<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds as Ids;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceRecipeManager;
use pocketmine\crafting\FurnaceType;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		// Register item instance
		ExperimentalItemFactory::init();

		// Add strings to parser
		$parser = StringToItemParser::getInstance();
		$parser->register("raw_iron", fn() => ExperimentalItems::RAW_IRON());
		$parser->register("raw_gold", fn() => ExperimentalItems::RAW_GOLD());

		// Register (override) block instance
		ExperimentalBlockFactory::init();

		// Hack network-item-translator
		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(Ids::RAW_IRON, Ids::NET_RAW_IRON);
		ItemTranslatorHack::hack(Ids::RAW_GOLD, Ids::NET_RAW_GOLD);

		// Add recipes
		$recipes = [
			new FurnaceRecipe(VanillaItems::IRON_INGOT(), ExperimentalItems::RAW_IRON()),
			new FurnaceRecipe(VanillaItems::GOLD_INGOT(), ExperimentalItems::RAW_GOLD()),
		];
		$craft = $this->getServer()->getCraftingManager();
		$furnaces = [
			$craft->getFurnaceRecipeManager(FurnaceType::FURNACE()),
			$craft->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE()),
		];
		foreach($furnaces as $furnace){
			foreach($recipes as $recipe){
				/** @var FurnaceRecipeManager $furnace */
				/** @var FurnaceRecipe $recipe */
				$furnace->register($recipe);
			}
		}
	}
}