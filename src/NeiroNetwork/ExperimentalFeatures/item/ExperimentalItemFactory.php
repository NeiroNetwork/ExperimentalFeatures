<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;

class ExperimentalItemFactory{

	public static function init() : void{
		$factory = ItemFactory::getInstance();
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_IRON, 0), "Raw Iron"));
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_GOLD, 0), "Raw Gold"));
	}
}