<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

final class FeaturesList{

	// 新しく作ったものは必ず一番下に追加する
	public const IMPLEMENTED_FEATURES = [
		"",
	];

	/** @var Feature[] */
	private static array $cache;

	public static function get() : array{
		return self::$cache ?? self::$cache = array_map(fn(string $class) => new $class(), self::IMPLEMENTED_FEATURES);
	}
}