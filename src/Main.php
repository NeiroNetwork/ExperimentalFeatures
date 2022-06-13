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
		$this->getLogger()->debug("Doing override");
		OverrideMan::callExperts();
		OverrideMan::reSetupVanillas();
		$this->getLogger()->debug("Registering new features");
		NewFeatureRegister::registerAll();
		$this->getLogger()->debug("Re-registering creative contents");
		CreativeContentsRegister::reRegister($this);
		CreativeContentsRegister::registerAdditionalItems();
		$this->getLogger()->debug("Re-registering recipes");
		RecipesRegister::registerAll($this);

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}
