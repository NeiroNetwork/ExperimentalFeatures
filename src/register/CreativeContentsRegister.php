<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
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
}