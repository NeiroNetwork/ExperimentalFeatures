<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\hack\VanillaItemsHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ExperimentalItemFactory::init();

		VanillaItemsHack::prepare();
		VanillaItemsHack::hack("raw_iron", ItemFactory::getInstance()->get(ExperimentalItemIds::RAW_IRON));
		VanillaItemsHack::hack("raw_iron", ItemFactory::getInstance()->get(ExperimentalItemIds::RAW_GOLD));

		ExperimentalBlockFactory::init();

		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_IRON, ExperimentalItemIds::NET_RAW_IRON);
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_GOLD, ExperimentalItemIds::NET_RAW_GOLD);
	}
}