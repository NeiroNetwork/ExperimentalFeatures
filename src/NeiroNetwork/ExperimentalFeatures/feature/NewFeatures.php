<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\nether\CrimsonDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\nether\CrimsonFence;
use NeiroNetwork\ExperimentalFeatures\feature\nether\CrimsonPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\nether\CrimsonSlab;
use NeiroNetwork\ExperimentalFeatures\feature\nether\WarpedDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\nether\WarpedFence;
use NeiroNetwork\ExperimentalFeatures\feature\nether\WarpedPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\nether\WarpedSlab;

final class NewFeatures{

	/** @var Feature[] */
	private static array $featureCache;

	public static function get() : array{
		if(!isset(self::$featureCache)){
			self::generate();
		}
		return self::$featureCache;
	}

	public static function generate() : void{
		// 要素の順番で内部IDが決定するので並び変えてはいけない
		self::$featureCache = [
			new RawIron(),
			new RawGold(),
			new RawIronBlock(),
			new RawGoldBlock(),
			new GlowInkSac(),
			new AmethystBlock(),
			new BuddingAmethyst(),
			new AmethystShard(),
			new LargeAmethystBud(),
			new MediumAmethystBud(),
			new SmallAmethystBud(),
			new AmethystCluster(),

			new CrimsonPlanks(),
			new CrimsonFence(),
			new CrimsonSlab(),
			new CrimsonDoubleSlab(),

			new WarpedPlanks(),
			new WarpedFence(),
			new WarpedSlab(),
			new WarpedDoubleSlab(),
		];
	}
}