<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

use pocketmine\item\Item;

class BaseAmethystBud extends BaseAmethystCluster{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}

	public function getDropsForIncompatibleTool(Item $item) : array{
		return [];
	}
}