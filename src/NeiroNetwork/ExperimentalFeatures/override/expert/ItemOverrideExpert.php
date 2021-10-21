<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;

class ItemOverrideExpert implements Expert{

	public function doOverride() : void{
		$reflection = new \ReflectionClass($this);
		foreach($reflection->getMethods(\ReflectionMethod::IS_PROTECTED) as $method){
			if((string) $method->getReturnType() === Item::class){
				ItemFactory::getInstance()->register(($method->getClosure($this))(), true);
			}
		}
	}

	protected function toIdentifier(Item $item) : ItemIdentifier{
		return new ItemIdentifier($item->getId(), $item->getMeta());
	}
}