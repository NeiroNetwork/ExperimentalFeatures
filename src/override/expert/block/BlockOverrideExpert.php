<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use NeiroNetwork\ExperimentalFeatures\override\expert\Expert;
use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

abstract class BlockOverrideExpert implements Expert{

	public function doOverride() : void{
		$reflection = new \ReflectionClass($this);
		foreach($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method){
			$array = match((string) $method->getReturnType()){
				"array" => ($method->getClosure($this))(),
				Block::class => [($method->getClosure($this))()],
				default => [],
			};
			foreach($array as $any){
				if($any instanceof Block){
					BlockFactory::getInstance()->register($any, true);
				}
			}
		}
	}
}
