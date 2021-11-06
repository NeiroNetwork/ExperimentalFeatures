<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\v1_11\Campfire;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\Beehive;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\BeeNest;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\HoneyBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\HoneyBottle;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\Honeycomb;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\HoneycombBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\AncientDebris;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Basalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Blackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\BlackstoneWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Chain;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\ChiseledPolishedBlackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrackedPolishedBlackstoneBricks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFenceGate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonFungus;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonNylium;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonPressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CrimsonTrapdoor;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\CryingObsidian;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\GildedBlackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Lodestone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\NetheriteIngot;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\NetheriteScrap;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBasalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstone;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneBricks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneBrickStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneBrickWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstonePressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\PolishedBlackstoneWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\QuartzBricks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SmoothBasalt;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SoulCampfire;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SoulFire;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SoulLantern;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SoulSoil;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\SoulTorch;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedCrimsonHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedCrimsonStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedWarpedHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\StrippedWarpedStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\Target;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\TwistingVines;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedButton;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFence;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFenceGate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedFungus;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedHyphae;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedNylium;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedPlanks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedPressurePlate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedStem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedTrapdoor;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WarpedWartBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\WeepingVines;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystCluster;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AmethystShard;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\Azalea;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AzaleaLeaves;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\AzaleaLeavesFlowered;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\BuddingAmethyst;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\Calcite;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ChiseledDeepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslateDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslateSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslateStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CobbledDeepslateWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CopperBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CopperIngot;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CopperOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CrackedDeepslateBricks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CrackedDeepslateTiles;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CutCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\CutCopperStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\Deepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateBrickDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateBricks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateBrickSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateBrickStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateBrickWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateCoalOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateCopperOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateDiamondOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateEmeraldOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateGoldOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateIronOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateLapisOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateRedstoneOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateTileDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateTiles;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateTileSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateTileStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DeepslateTileWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\DoubleCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ExposedCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ExposedCutCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ExposedCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ExposedCutCopperStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\ExposedDoubleCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\FloweringAzalea;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\GlowInkSac;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\InfestedDeepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\LargeAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\LitDeepslateRedstoneOre;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\MediumAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\OxidizedCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\OxidizedCutCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\OxidizedCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\OxidizedCutCopperStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\OxidizedDoubleCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\PolishedDeepslate;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\PolishedDeepslateDoubleSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\PolishedDeepslateSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\PolishedDeepslateStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\PolishedDeepslateWall;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawCopperBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGold;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawGoldBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIron;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\RawIronBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\SmallAmethystBud;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\TintedGlass;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\Tuff;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\WeatheredCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\WeatheredCutCopper;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\WeatheredCutCopperSlab;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\WeatheredCutCopperStairs;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\WeatheredDoubleCutCopperSlab;

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
		PolishedBlackstoneDoubleSlab::class,
		PolishedBlackstoneWall::class,
		PolishedBlackstoneStairs::class,
		PolishedBlackstoneButton::class,
		PolishedBlackstonePressurePlate::class,
		Basalt::class,
		PolishedBasalt::class,
		SmoothBasalt::class,
		CryingObsidian::class,
		AncientDebris::class,
		Deepslate::class,
		CobbledDeepslate::class,
		NetheriteScrap::class,
		CobbledDeepslateWall::class,
		DeepslateTileWall::class,
		PolishedDeepslateWall::class,
		DeepslateBrickWall::class,
		CobbledDeepslateStairs::class,
		DeepslateTileStairs::class,
		PolishedDeepslateStairs::class,
		DeepslateBrickStairs::class,
		CobbledDeepslateSlab::class,
		CobbledDeepslateDoubleSlab::class,
		PolishedDeepslateSlab::class,
		PolishedDeepslateDoubleSlab::class,
		DeepslateTileSlab::class,
		DeepslateTileDoubleSlab::class,
		DeepslateBrickSlab::class,
		DeepslateBrickDoubleSlab::class,
		DeepslateTiles::class,
		CrackedDeepslateTiles::class,
		DeepslateBricks::class,
		CrackedDeepslateBricks::class,
		ChiseledDeepslate::class,
		PolishedDeepslate::class,
		InfestedDeepslate::class,
		SoulFire::class,
		SoulTorch::class,
		SoulLantern::class,
		Calcite::class,
		Tuff::class,
		Chain::class,
		RawCopper::class,
		CopperIngot::class,
		RawCopperBlock::class,
		CopperOre::class,
		CopperBlock::class,
		CutCopper::class,
		CutCopperSlab::class,
		DoubleCutCopperSlab::class,
		CutCopperStairs::class,
		ExposedCopper::class,
		ExposedCutCopper::class,
		ExposedCutCopperSlab::class,
		ExposedDoubleCutCopperSlab::class,
		ExposedCutCopperStairs::class,
		WeatheredCopper::class,
		WeatheredCutCopper::class,
		WeatheredCutCopperSlab::class,
		WeatheredDoubleCutCopperSlab::class,
		WeatheredCutCopperStairs::class,
		DeepslateLapisOre::class,
		DeepslateRedstoneOre::class,
		DeepslateCopperOre::class,
		DeepslateIronOre::class,
		DeepslateGoldOre::class,
		DeepslateEmeraldOre::class,
		DeepslateDiamondOre::class,
		DeepslateCoalOre::class,
		LitDeepslateRedstoneOre::class,
		Target::class,
		QuartzBricks::class,
		SoulSoil::class,
		OxidizedCopper::class,
		OxidizedCutCopper::class,
		OxidizedDoubleCutCopperSlab::class,
		OxidizedCutCopperStairs::class,
		OxidizedCutCopperSlab::class,
		CrimsonFungus::class,
		WarpedFungus::class,
		Lodestone::class,
		WeepingVines::class,
		TwistingVines::class,
		CrimsonNylium::class,
		WarpedNylium::class,
		Campfire::class,
		SoulCampfire::class,
		FloweringAzalea::class,
		Azalea::class,
		AzaleaLeaves::class,
		AzaleaLeavesFlowered::class,
		GildedBlackstone::class,
		CrackedPolishedBlackstoneBricks::class,
		ChiseledPolishedBlackstone::class,
		PolishedBlackstoneBricks::class,
		PolishedBlackstoneBrickStairs::class,
		PolishedBlackstoneBrickWall::class,
		HoneycombBlock::class,
		Honeycomb::class,
		BeeNest::class,
		Beehive::class,
		HoneyBottle::class,
		HoneyBlock::class,
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