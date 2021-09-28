<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

final class InternalIdCounter{

	private static $count = 600;

	public static function next() : int{
		return self::$count++;
	}
}