<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\item\BlockFactory;
use NeiroNetwork\ExperimentalFeatures\item\ItemFactory;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		ItemFactory::init();
		BlockFactory::init();
	}
}