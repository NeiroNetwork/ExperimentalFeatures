<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use NeiroNetwork\ExperimentalFeatures\feature\block\convert\SlabConverter;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class DoubleSlab extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [SlabConverter::toSlab($this)->asItem()->setCount(2)];
	}

	public function getPickedItem(bool $addUserData = false) : Item{
		return SlabConverter::toSlab($this)->asItem();
	}
}
