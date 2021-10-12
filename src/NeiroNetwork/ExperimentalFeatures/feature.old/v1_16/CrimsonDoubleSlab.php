<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Planks;
use pocketmine\item\Item;

class CrimsonDoubleSlab extends Feature implements IBlockOnly{

	public function networkId() : int{
		return -266;
	}

	public function name() : string{
		return "crimson_double_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Crimson Double Slab", new BlockBreakInfo(2.0, BlockToolType::AXE, 0, 15.0)
		) extends Planks{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalBlocks::CRIMSON_SLAB()->asItem()->setCount(2)];
			}
			public function getPickedItem(bool $addUserData = false) : Item{
				return ExperimentalBlocks::CRIMSON_SLAB()->asItem();
			}
		};
	}
}