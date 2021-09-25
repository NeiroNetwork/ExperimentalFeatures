<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\utils\TreeType;
use pocketmine\item\ToolTier;

class ExperimentalBlockFactory{

	public static function init() : void{
		$factory = BlockFactory::getInstance();
		$factory->register(new IronOre(new BID(BlockLegacyIds::IRON_ORE, 0), "Iron Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel())), true);
		$factory->register(new GoldOre(new BID(BlockLegacyIds::GOLD_ORE, 0), "Gold Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel())), true);

		$signBreakInfo = new BlockBreakInfo(1.0, BlockToolType::AXE);
		foreach(TreeType::getAll() as $treeType){
			$name = $treeType->getDisplayName();
			$factory->register(new FloorSign(BlockLegacyIdHelper::getWoodenFloorSignIdentifier($treeType), $name . " Sign", $signBreakInfo), true);
			$factory->register(new WallSign(BlockLegacyIdHelper::getWoodenWallSignIdentifier($treeType), $name . " Wall Sign", $signBreakInfo), true);
		}
	}
}