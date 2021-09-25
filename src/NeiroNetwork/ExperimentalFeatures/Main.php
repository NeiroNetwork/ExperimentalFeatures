<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalTileFactory;
use NeiroNetwork\ExperimentalFeatures\crafting\CraftingRecipeInitializer;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ExperimentalBlockFactory::init();
		ExperimentalItemFactory::init();
		ExperimentalTileFactory::init();
		CraftingRecipeInitializer::init();

		var_dump(LegacyBlockIdToStringIdMap::getInstance()->legacyToString(603));
	}
}