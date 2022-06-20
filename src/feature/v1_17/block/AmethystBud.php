<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17\block;

use pocketmine\item\Item;

abstract class AmethystBud extends BaseAmethystCluster{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}

	public function getDropsForIncompatibleTool(Item $item) : array{
		return [];
	}
}
