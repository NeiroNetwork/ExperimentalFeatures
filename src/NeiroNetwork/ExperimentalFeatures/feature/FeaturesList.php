<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\NetheriteIngot;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystShard;

final class FeaturesList{

	// 新しく作ったものは必ず一番下に追加する
	public const IMPLEMENTED_FEATURES = [
		CrimsonPlanks::class,
		NetheriteIngot::class,
		AmethystBlock::class,
		AmethystShard::class,
		CrimsonStem::class,
		CrimsonSlab::class,
		CrimsonDoubleSlab::class,
	];

	/** @var Feature[] */
	private static array $cache;

	public static function get() : array{
		return self::$cache ?? self::$cache = array_map(fn(string $class) => new $class(), self::IMPLEMENTED_FEATURES);
	}
}