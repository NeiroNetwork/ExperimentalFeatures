<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class IronOre{

	public function __construct(){
		$block = new class(
			new BlockIdentifier(BlockLegacyIds::IRON_ORE, 0),
			"Iron Ore",
			new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel())
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalItems::RAW_IRON()];
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};

		BlockFactory::getInstance()->register($block, true);
	}
}