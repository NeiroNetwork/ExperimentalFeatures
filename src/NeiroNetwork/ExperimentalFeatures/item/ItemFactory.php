<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class ItemFactory{

	public static function init() : void{
		$factory = \pocketmine\item\ItemFactory::getInstance();
		$factory->register(new Item(new ItemIdentifier(ItemIds::RAW_IRON, 0), "Raw Iron"));
		$factory->register(new Item(new ItemIdentifier(ItemIds::RAW_GOLD, 0), "Raw Gold"));
	}
}