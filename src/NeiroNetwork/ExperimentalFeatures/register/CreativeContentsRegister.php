<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\Main;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;

class CreativeContentsRegister{

	/**
	 * @param Item[] $additionalContents
	 */
	public static function register(array $additionalContents) : void{
		$resource = Main::getInstance()->getResource("creative_contents.json");
		$vanilla = json_decode(stream_get_contents($resource), true);
		fclose($resource);
		$creative = CreativeInventory::getInstance()->getAll();

		foreach($additionalContents as $item){
		}
	}
}