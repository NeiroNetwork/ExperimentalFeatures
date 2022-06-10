<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;

class NetherGoldOre extends Feature implements IBlock{

	public function stringId() : string{
		return "nether_gold_ore";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::GOLD_NUGGET()->setCount(mt_rand(2, 6))];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}