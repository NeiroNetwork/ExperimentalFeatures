<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\BlockFactory;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\item\ItemFactory;
use NeiroNetwork\ExperimentalFeatures\item\ItemIds;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ItemFactory::init();
		BlockFactory::init();

		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(ItemIds::CORE_RAW_IRON, ItemIds::NET_RAW_IRON);
		ItemTranslatorHack::hack(ItemIds::CORE_RAW_GOLD, ItemIds::NET_RAW_GOLD);
	}
}