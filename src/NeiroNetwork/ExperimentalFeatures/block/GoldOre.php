<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class GoldOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			VanillaItems::RAW_GOLD()
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}