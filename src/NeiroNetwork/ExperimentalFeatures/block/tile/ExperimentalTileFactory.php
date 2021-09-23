<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block\tile;

use pocketmine\block\tile\TileFactory;

class ExperimentalTileFactory{

	public static function init() : void{
		$factory = TileFactory::getInstance();
		$factory->register(ExperimentalSign::class, ["Sign", "minecraft:sign"]);
	}
}