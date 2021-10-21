<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

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
			array_map(fn($any) => $any instanceof Block && BlockFactory::getInstance()->register($any, true), $array);
		}
	}
}