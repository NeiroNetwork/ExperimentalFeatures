<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class BlackstoneDoubleSlab extends Feature implements IBlockOnly{

	public function networkId() : int{
		return -283;
	}

	public function name() : string{
		return "blackstone_double_slab";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "Blackstone Double Slab", new BlockBreakInfo(2.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalBlocks::BLACKSTONE_SLAB()->asItem()->setCount(2)];
			}
			public function getPickedItem(bool $addUserData = false) : Item{
				return ExperimentalBlocks::BLACKSTONE_SLAB()->asItem();
			}
		};
	}
}