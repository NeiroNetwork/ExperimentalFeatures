<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\Opaque;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\item\Item;

class DoubleSlab extends Opaque{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [$this->toSlab()->asItem()->setCount(2)];
	}

	public function getPickedItem(bool $addUserData = false) : Item{
		return $this->toSlab()->asItem();
	}

	protected function toSlab() : Block{
		$id = str_replace("double_slab", "slab", LegacyBlockIdToStringIdMap::getInstance()->legacyToString($this->getId()));
		return ExperimentalBlocks::fromString($id);
	}
}