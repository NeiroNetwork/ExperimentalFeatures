<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\Main;
use pocketmine\inventory\CreativeInventory;

class CreativeContentsRegister{

	/**
	 * @param Feature[] $additionalFeatures
	 */
	public static function register(array $additionalFeatures) : void{
		$resource = Main::getInstance()->getResource("creative_contents.json");
		$vanilla = json_decode(stream_get_contents($resource), true);
		fclose($resource);
		$creative = CreativeInventory::getInstance()->getAll();

		foreach($additionalFeatures as $feature){
		}
	}
}