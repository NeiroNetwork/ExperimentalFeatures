<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

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
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\NetheriteIngot;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneDoudleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstonePuressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneWall;
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
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\GlowInkSac;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\LargeAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\MediumAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGold;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGoldBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIron;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIronBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\SmallAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\TintedGlass;

final class FeaturesList{

	// 新しく作ったものは必ず一番下に追加する
	public const IMPLEMENTED_FEATURES = [
		CrimsonPlanks::class,
		NetheriteIngot::class,
		AmethystBlock::class,
		CrimsonStem::class,
		CrimsonSlab::class,
		CrimsonDoubleSlab::class,
		BuddingAmethyst::class,
		AmethystCluster::class,
		LargeAmethystBud::class,
		MediumAmethystBud::class,
		SmallAmethystBud::class,
		AmethystShard::class,
		GlowInkSac::class,
		RawIron::class,
		RawIronBlock::class,
		RawGold::class,
		RawGoldBlock::class,
		TintedGlass::class,
		CrimsonButton::class,
		CrimsonFence::class,
		CrimsonFenceGate::class,
		CrimsonHyphae::class,
		CrimsonPressurePlate::class,
		CrimsonStairs::class,
		CrimsonTrapdoor::class,
		StrippedCrimsonHyphae::class,
		StrippedCrimsonStem::class,
		WarpedWartBlock::class,
		StrippedWarpedHyphae::class,
		StrippedWarpedStem::class,
		WarpedHyphae::class,
		WarpedStem::class,
		WarpedButton::class,
		WarpedDoubleSlab::class,
		WarpedSlab::class,
		WarpedFence::class,
		WarpedFenceGate::class,
		WarpedPlanks::class,
		WarpedPressurePlate::class,
		WarpedStairs::class,
		WarpedTrapdoor::class,
		Blackstone::class,
		BlackstoneWall::class,
		BlackstoneStairs::class,
		BlackstoneSlab::class,
		BlackstoneDoubleSlab::class,
		PolishedBlackstone::class,
		PolishedBlackstoneSlab::class,
		PolishedBlackstoneDoudleSlab::class,
		PolishedBlackstoneWall::class,
		PolishedBlackstoneStairs::class,
		PolishedBlackstoneButton::class,
		PolishedBlackstonePuressurePlate::class,
	];

	/** @var Feature[] */
	private static array $cache;

	public static function get() : array{
		if(!isset(self::$cache)){
			self::$cache = [];
			foreach(self::IMPLEMENTED_FEATURES as $featureClass){
				$feature = new $featureClass();
				assert($feature instanceof Feature);
				self::$cache[] = $feature;
			}
		}
		return self::$cache;
	}
}