<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class IronOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			ExperimentalItems::RAW_IRON()
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}