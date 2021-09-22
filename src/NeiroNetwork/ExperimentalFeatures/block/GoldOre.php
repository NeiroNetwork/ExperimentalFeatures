<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class GoldOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			ExperimentalItems::RAW_GOLD()
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}