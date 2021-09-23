<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\StringToItemParser;

class ExperimentalItemFactory{

	public static function init() : void{
		self::registerItems();
		self::registerItemStrings();
		self::hackItemTranslator();
	}

	private static function registerItems() : void{
		$factory = ItemFactory::getInstance();
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_IRON, 0), "Raw Iron"));
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_GOLD, 0), "Raw Gold"));
	}

	private static function registerItemStrings() : void{
		$parser = StringToItemParser::getInstance();
		$parser->register("raw_iron", fn() => ExperimentalItems::RAW_IRON());
		$parser->register("raw_gold", fn() => ExperimentalItems::RAW_GOLD());
	}

	private static function hackItemTranslator() : void{
		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_IRON, ExperimentalItemIds::NET_RAW_IRON);
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_GOLD, ExperimentalItemIds::NET_RAW_GOLD);
	}
}