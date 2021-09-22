<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;

class BlockFactory{

	public static function init() : void{
		$factory = \pocketmine\block\BlockFactory::getInstance();
		$factory->register(new IronOre(new BlockIdentifier(BlockLegacyIds::IRON_ORE, 0), "Iron Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel())), true);
		$factory->register(new GoldOre(new BlockIdentifier(BlockLegacyIds::GOLD_ORE, 0), "Gold Ore", new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel())), true);
	}
}