<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block\convert;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;

class SlabConverter{

	public static function toSlab(Block $from) : Block{
		$string = LegacyBlockIdToStringIdMap::getInstance()->legacyToString($from->getId());
		$id = str_replace(["minecraft:", "double_slab"], ["", "slab"], $string);
		return ExperimentalBlocks::fromString($id);
	}

	public static function toDouble(Block $from) : Block{
		$string = LegacyBlockIdToStringIdMap::getInstance()->legacyToString($from->getId());
		$id = str_replace(["minecraft:", "slab"], ["", "double_slab"], $string);
		return ExperimentalBlocks::fromString($id);
	}
}