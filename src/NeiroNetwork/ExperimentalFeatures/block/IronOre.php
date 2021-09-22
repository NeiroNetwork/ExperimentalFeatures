<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class IronOre extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			VanillaItems::RAW_IRON()
		];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}