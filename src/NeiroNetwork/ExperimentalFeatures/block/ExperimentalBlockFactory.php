<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\hack\BlockMappingHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\utils\TreeType;
use pocketmine\item\ToolTier;

class ExperimentalBlockFactory{

	public static function init() : void{
		self::registerBlocks();
		self::overrideSigns();
		self::registerBlocksToNetworkLayer();
	}

	public static function registerBlocks() : void{
		$factory = BlockFactory::getInstance();
		$factory->register(new IronOre(new BID(BlockLegacyIds::IRON_ORE, 0), "Iron Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel())), true);
		$factory->register(new GoldOre(new BID(BlockLegacyIds::GOLD_ORE, 0), "Gold Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel())), true);
		$factory->register(new Opaque(new BID(ExperimentalItemIds::RAW_IRON_BLOCK, 0, ExperimentalItemIds::RAW_IRON_BLOCK), "Raw Iron Block", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)));
		$factory->register(new Opaque(new BID(ExperimentalItemIds::RAW_GOLD_BLOCK, 0, ExperimentalItemIds::RAW_GOLD_BLOCK), "Raw Gold Block", new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)));
	}

	public static function overrideSigns() : void{
		$factory = BlockFactory::getInstance();
		$signBreakInfo = new BlockBreakInfo(1.0, BlockToolType::AXE);
		foreach(TreeType::getAll() as $treeType){
			$name = $treeType->getDisplayName();
			$factory->register(new FloorSign(BlockLegacyIdHelper::getWoodenFloorSignIdentifier($treeType), $name . " Sign", $signBreakInfo), true);
			$factory->register(new WallSign(BlockLegacyIdHelper::getWoodenWallSignIdentifier($treeType), $name . " Wall Sign", $signBreakInfo), true);
		}
	}

	public static function registerBlocksToNetworkLayer(){
		BlockMappingHack::prepare();
		BlockMappingHack::hack("minecraft:raw_iron_block", ExperimentalBlocks::RAW_IRON());
		BlockMappingHack::hack("minecraft:raw_gold_block", ExperimentalBlocks::RAW_GOLD());
	}
}