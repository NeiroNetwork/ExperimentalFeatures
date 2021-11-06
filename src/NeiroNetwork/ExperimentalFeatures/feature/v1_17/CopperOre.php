<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\block\Pillar;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class CopperOre extends Feature implements IBlock{

	public function stringId() : string{
		return "copper_ore";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		) extends Pillar{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalItems::fromString("raw_copper")->setCount(mt_rand(2, 3))];
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}