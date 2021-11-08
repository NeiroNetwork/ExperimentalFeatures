<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\override\OverrideMan;
use NeiroNetwork\ExperimentalFeatures\register\CreativeContentsRegister;
use NeiroNetwork\ExperimentalFeatures\register\NewFeatureRegister;
use NeiroNetwork\ExperimentalFeatures\register\RecipesRegister;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		NewFeatureRegister::registerAll();
		CreativeContentsRegister::reRegister($this);
		RecipesRegister::registerAll($this);
		OverrideMan::callExperts();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}