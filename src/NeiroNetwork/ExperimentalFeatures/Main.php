<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\override\OverrideList;
use NeiroNetwork\ExperimentalFeatures\register\NewFeatureRegister;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		NewFeatureRegister::registerAll();
		//OverrideList::override();
	}
}