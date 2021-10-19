<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;

class DeepslateRedstoneOre extends Feature implements IBlock{

	public function stringId() : string{
		return "deepslate_redstone_ore";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(4.5, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)
		) extends Opaque{

			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::fromString("redstone_dust")->setCount(mt_rand(4, 5))];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}