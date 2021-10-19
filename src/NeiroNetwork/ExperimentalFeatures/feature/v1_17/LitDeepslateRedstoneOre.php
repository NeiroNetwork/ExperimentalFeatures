<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;

// FIXME: IBlockだけどクリエイティブインベントリに追加されない
class LitDeepslateRedstoneOre extends Feature implements IBlock{

	function stringId() : string{
		return "lit_deepslate_redstone_ore";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(4.5, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)
		) extends Opaque{
			public function getLightLevel() : int{
				return 9;
			}
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::REDSTONE_DUST()->setCount(mt_rand(4, 5))];
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
			public function getSilkTouchDrops(Item $item) : array{
				return [ExperimentalBlocks::fromString("deepslate_redstone_ore")->asItem()];
			}
			protected function getXpDropAmount() : int{
				return mt_rand(1, 5);
			}
			public function getPickedItem(bool $addUserData = false) : Item{
				return ExperimentalBlocks::fromString("deepslate_redstone_ore")->asItem();
			}
		};
	}
}