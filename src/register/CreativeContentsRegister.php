<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;

class CreativeContentsRegister{

	public static function reRegister(PluginBase $plugin) : void{
		$resource = $plugin->getResource("creative_contents.json");
		$creativeItems = json_decode(stream_get_contents($resource), true);
		fclose($resource);

		$contents = [];
		foreach($creativeItems as $data){
			$item = is_array($data) ? Item::jsonDeserialize($data) :
				StringToItemParser::getInstance()->parse(str_replace("minecraft:", "", $data));
			if($item === null || $item->getName() === "Unknown"){
				continue;
			}
			$contents[] = $item;
		}

		$inventory = CreativeInventory::getInstance();
		$creative = (new \ReflectionClass($inventory))->getProperty("creative");
		$creative->setAccessible(true);
		$creative->setValue($inventory, $contents);
	}

	public static function registerAdditionalItems() : void{
		$addItem = function(int $id, int $meta = 0) : void{
			CreativeInventory::getInstance()->add(ItemFactory::getInstance()->get($id, $meta));
		};

		// 強化ガラス
		$addItem(ItemIds::HARD_GLASS);
		for($i = 0; $i < 16; $i++) $addItem(ItemIds::HARD_STAINED_GLASS, $i);
		$addItem(ItemIds::HARD_GLASS_PANE);
		for($i = 0; $i < 16; $i++) $addItem(ItemIds::HARD_STAINED_GLASS_PANE, $i);

		// 色付きの松明
		$addItem(ItemIds::COLORED_TORCH_BP, 0);
		$addItem(ItemIds::COLORED_TORCH_BP, 8);
		$addItem(ItemIds::COLORED_TORCH_RG, 0);
		$addItem(ItemIds::COLORED_TORCH_RG, 8);

		// 水中の松明
		$addItem(ItemIds::UNDERWATER_TORCH);
	}
}