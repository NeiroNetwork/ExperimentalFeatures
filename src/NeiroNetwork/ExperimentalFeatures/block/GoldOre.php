<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class GoldOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			ItemFactory::getInstance()->get(ItemIds::RAW_GOLD)
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}