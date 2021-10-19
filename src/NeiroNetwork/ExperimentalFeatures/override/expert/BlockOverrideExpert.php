<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

abstract class BlockOverrideExpert implements Expert{

	public function doOverride() : void{
		$reflection = new \ReflectionClass($this);
		foreach($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method){
			if((string) $method->getReturnType() === Block::class){
				BlockFactory::getInstance()->register(($method->getClosure($this))(), true);
			}
		}
	}
}