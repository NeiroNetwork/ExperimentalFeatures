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
		$this->getLogger()->debug("Registering new features");
		NewFeatureRegister::registerAll();
		$this->getLogger()->debug("Re-registering creative contents");
		CreativeContentsRegister::reRegister($this);
		$this->getLogger()->debug("Re-registering recipes");
		RecipesRegister::registerAll($this);
		$this->getLogger()->debug("Doing override");
		OverrideMan::callExperts();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}