<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block\convert;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;

class SlabConverter{

	private static array $cache = [];

	public static function toSlab(Block $from) : Block{
		if(!isset(self::$cache[$from->getId()])){
			$string = LegacyBlockIdToStringIdMap::getInstance()->legacyToString($from->getId());
			self::$cache[$from->getId()] = str_replace("minecraft:", "", self::internalToSlab($string));
		}
		return ExperimentalBlocks::fromString(self::$cache[$from->getId()]);
	}

	public static function toDouble(Block $from) : Block{
		if(!isset(self::$cache[$from->getId()])){
			$string = LegacyBlockIdToStringIdMap::getInstance()->legacyToString($from->getId());
			self::$cache[$from->getId()] = str_replace("minecraft:", "", self::internalToDouble($string));
		}
		return ExperimentalBlocks::fromString(self::$cache[$from->getId()]);
	}

	private static function internalToSlab(string $fullId) : string{
		return match(true){
			str_contains($fullId, "cut_copper_slab") => str_replace("double_cut_copper_slab", "cut_copper_slab", $fullId),
			default => str_replace("double_slab", "slab", $fullId),
		};
	}

	private static function internalToDouble(string $fullId) : string{
		return match(true){
			str_contains($fullId, "cut_copper_slab") => str_replace("cut_copper_slab", "double_cut_copper_slab", $fullId),
			default => str_replace("slab", "double_slab", $fullId),
		};
	}
}