<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalTileFactory;
use NeiroNetwork\ExperimentalFeatures\crafting\CraftingRecipeInitializer;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds as Ids;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ExperimentalItemFactory::init();
		ExperimentalBlockFactory::init();
		ExperimentalTileFactory::init();
		CraftingRecipeInitializer::init();
	}
}