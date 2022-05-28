<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use NeiroNetwork\ExperimentalFeatures\helper\PhpClassesEnumerater;
use NeiroNetwork\ExperimentalFeatures\override\expert\Expert;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;

class OverrideMan{

	public static function callExperts() : void{
		$classes = PhpClassesEnumerater::list("override/expert", Expert::class);
		foreach($classes as $class){
			(new $class())->doOverride();
		}
	}

	public static function reSetupVanillas() : void{
		$reSetup = function(string $class) : void{
			$reflection = new \ReflectionClass($class);

			$members = $reflection->getProperty("members");
			$members->setAccessible(true);
			$members->setValue([]);

			$setup = $reflection->getMethod("setup");
			$setup->setAccessible(true);
			$setup->invoke(null);
		};

		$reSetup(VanillaBlocks::class);
		$reSetup(VanillaItems::class);
	}
}