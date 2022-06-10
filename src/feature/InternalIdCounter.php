<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

final class InternalIdCounter{

	/**
	 * block_id_map.json, item_id_map.json を参照
	 * ブロック: 0 ~ 559
	 * アイテム: -304 ~ 801
	 */
	private static int $count = 810;

	public static function next() : int{
		return self::$count++;
	}
}