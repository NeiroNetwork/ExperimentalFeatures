<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\override\OverrideList;
use NeiroNetwork\ExperimentalFeatures\register\NewFeatureRegister;
use NeiroNetwork\ExperimentalFeatures\register\RecipesRegister;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		NewFeatureRegister::registerAll();
		RecipesRegister::registerAll($this);
		OverrideList::override();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}