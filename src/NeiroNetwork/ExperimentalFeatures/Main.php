<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\feature\NewFeatures;
use NeiroNetwork\ExperimentalFeatures\override\OverrideList;
use NeiroNetwork\ExperimentalFeatures\register\NewFeatureRegister;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		$newFeatureRegister = new NewFeatureRegister();
		foreach(NewFeatures::get() as $feature) $newFeatureRegister->register($feature);
		foreach(NewFeatures::get() as $feature) $newFeatureRegister->registerRecipe($feature);
		//foreach(NewFeatures::get() as $feature) $newFeatureRegister->remapExistsRecipe($feature);
		OverrideList::override();
	}
}