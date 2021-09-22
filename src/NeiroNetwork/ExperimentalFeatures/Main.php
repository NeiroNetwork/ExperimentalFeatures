<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\hack\VanillaItemsHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds as Ids;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ExperimentalItemFactory::init();

		VanillaItemsHack::prepare();
		$factory = ItemFactory::getInstance();
		VanillaItemsHack::hack("raw_iron", $factory->get(Ids::RAW_IRON));
		VanillaItemsHack::hack("raw_gold", $factory->get(Ids::RAW_GOLD));

		ExperimentalBlockFactory::init();

		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(Ids::RAW_IRON, Ids::NET_RAW_IRON);
		ItemTranslatorHack::hack(Ids::RAW_GOLD, Ids::NET_RAW_GOLD);
	}
}