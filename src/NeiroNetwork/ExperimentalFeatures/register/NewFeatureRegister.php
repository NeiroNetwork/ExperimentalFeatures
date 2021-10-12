<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\FeaturesList;

class NewFeatureRegister{

	private static bool $initialized = false;

	public static function registerAll() : void{
		if(!self::$initialized){
			self::$initialized = true;

			array_map(fn($feature) => self::register($feature), FeaturesList::get());
		}
	}

	private static function register(Feature $feature) : void{
	}
}