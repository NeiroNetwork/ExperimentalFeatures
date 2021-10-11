<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

final class InternalIdCounter{

	private static int $count = 600;

	public static function next() : int{
		return self::$count++;
	}
}