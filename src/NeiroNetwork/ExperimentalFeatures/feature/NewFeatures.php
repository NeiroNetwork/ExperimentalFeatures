<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedCrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedWartBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystCluster;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystShard;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\BuddingAmethyst;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\GlowInkSac;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\LargeAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\MediumAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGold;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGoldBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIron;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIronBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\SmallAmethystBud;

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
			new CrimsonStem(),
			new StrippedCrimsonStem(),
			new WarpedPlanks(),
			new WarpedFence(),
			new WarpedSlab(),
			new WarpedDoubleSlab(),
			new WarpedWartBlock(),
			new WarpedStem(),
			new StrippedCrimsonStem(),
		];
	}
}