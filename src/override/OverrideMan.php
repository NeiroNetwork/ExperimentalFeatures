<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use NeiroNetwork\ExperimentalFeatures\helper\PhpClassesEnumerater;
use NeiroNetwork\ExperimentalFeatures\override\expert\Expert;

class OverrideMan{

	public static function callExperts() : void{
		$classes = PhpClassesEnumerater::list("override/expert", Expert::class);
		foreach($classes as $class){
			(new $class())->doOverride();
		}
	}
}