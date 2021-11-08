<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\override\OverrideMan;
use NeiroNetwork\ExperimentalFeatures\register\NewFeatureRegister;
use NeiroNetwork\ExperimentalFeatures\register\RecipesRegister;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	private static self $instance;

	public static function getInstance() : self{
		return self::$instance;
	}

	protected function onEnable() : void{
		self::$instance = $this;

		NewFeatureRegister::registerAll();
		RecipesRegister::registerAll($this);
		OverrideMan::callExperts();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}