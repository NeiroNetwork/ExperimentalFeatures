<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Basalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Blackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFenceGate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonTrapdoor;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBasalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SmoothBasalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedCrimsonHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedCrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedWarpedHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedWarpedStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFenceGate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedPressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedTrapdoor;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedWartBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystCluster;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystShard;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\BuddingAmethyst;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\Deepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\GlowInkSac;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\LargeAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\MediumAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGold;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGoldBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIron;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIronBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\SmallAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\TintedGlass;

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
			// 1.17~
			new RawIron(),
			new RawGold(),
			new RawIronBlock(),
			new RawGoldBlock(),
			new GlowInkSac(),
			new AmethystBlock(),
			new BuddingAmethyst(),
			new AmethystCluster(),
			new LargeAmethystBud(),
			new MediumAmethystBud(),
			new SmallAmethystBud(),
			new AmethystShard(),

			// 真紅の木
			new CrimsonPlanks(),
			new CrimsonFence(),
			new CrimsonFenceGate(),
			new CrimsonStairs(),
			new CrimsonTrapdoor(),
			new CrimsonSlab(),
			new CrimsonDoubleSlab(),
			new CrimsonButton(),
			new CrimsonPressurePlate(),
			new CrimsonStem(),
			new StrippedCrimsonStem(),
			new CrimsonHyphae(),
			new StrippedCrimsonHyphae(),
			// 歪んだ木
			new WarpedPlanks(),
			new WarpedFence(),
			new WarpedFenceGate(),
			new WarpedStairs(),
			new WarpedTrapdoor(),
			new WarpedSlab(),
			new WarpedDoubleSlab(),
			new WarpedButton(),
			new WarpedPressurePlate(),
			new WarpedStem(),
			new StrippedWarpedStem(),
			new WarpedHyphae(),
			new StrippedWarpedHyphae(),

			new WarpedWartBlock(),

			new Blackstone(),
			new BlackstoneWall(),
			new BlackstoneSlab(),
			new BlackstoneDoubleSlab(),
			new BlackstoneStairs(),
			new PolishedBlackstone(),

			new TintedGlass(),

			new Deepslate(),
			new CobbledDeepslate(),

			new Basalt(),
			new PolishedBasalt(),
			new SmoothBasalt(),

		];
	}
}