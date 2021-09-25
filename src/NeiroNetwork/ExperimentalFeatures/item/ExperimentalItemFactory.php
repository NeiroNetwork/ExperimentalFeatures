<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\StringToItemParser;

class ExperimentalItemFactory{

	public static function init() : void{
		self::registerItems();
		self::registerItemStrings();
		self::hackItemTranslator();
		self::registerCreativeItems();
	}

	private static function registerItems() : void{
		$factory = ItemFactory::getInstance();
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_IRON, 0), "Raw Iron"));
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::RAW_GOLD, 0), "Raw Gold"));
		$factory->register(new Item(new ItemIdentifier(ExperimentalItemIds::GLOW_INK_SAC, 0), "Glow Ink Sac"));
	}

	private static function registerItemStrings() : void{
		$parser = StringToItemParser::getInstance();
		$parser->register("raw_iron", fn() => ExperimentalItems::RAW_IRON());
		$parser->register("raw_gold", fn() => ExperimentalItems::RAW_GOLD());
		$parser->register("glow_ink_sac", fn() => ExperimentalItems::GLOW_INK_SAC());
		$parser->registerBlock("raw_iron_block", fn() => ExperimentalBlocks::RAW_IRON());
		$parser->registerBlock("raw_gold_block", fn() => ExperimentalBlocks::RAW_GOLD());
	}

	private static function hackItemTranslator() : void{
		ItemTranslatorHack::prepare();
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_IRON, NetworkItemIds::RAW_IRON);
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_GOLD, NetworkItemIds::RAW_GOLD);
		ItemTranslatorHack::hack(ExperimentalItemIds::GLOW_INK_SAC, NetworkItemIds::GLOW_INK_SAC);
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_IRON_BLOCK, NetworkItemIds::RAW_IRON_BLOCK);
		ItemTranslatorHack::hack(ExperimentalItemIds::RAW_GOLD_BLOCK, NetworkItemIds::RAW_GOLD_BLOCK);
	}

	private static function registerCreativeItems() : void{
		$inventory = CreativeInventory::getInstance();
		$inventory->add(ExperimentalItems::RAW_IRON());
		$inventory->add(ExperimentalItems::RAW_GOLD());
		$inventory->add(ExperimentalItems::GLOW_INK_SAC());
	}
}