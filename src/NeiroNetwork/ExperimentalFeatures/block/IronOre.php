<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\item\ItemIds;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class IronOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			ItemFactory::getInstance()->get(ItemIds::RAW_IRON)
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}