<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\base;

use pocketmine\item\Item;

abstract class BaseAmethystBud extends BaseAmethystCluster{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}
}