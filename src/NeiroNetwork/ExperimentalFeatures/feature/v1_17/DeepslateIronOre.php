<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class DeepslateIronOre extends Feature implements IBlock{

	public function stringId() : string{
		return "deepslate_iron_ore";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(4.5, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		) extends Opaque{

			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalItems::fromString("raw_iron")];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}