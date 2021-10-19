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
use pocketmine\math\Vector3;
use pocketmine\player\Player;

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
			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				$this->position->getWorld()->setBlock($this->position, ExperimentalBlocks::fromString("lit_deepslate_redstone_ore"));
				return false;
			}
			public function onNearbyBlockChange() : void{
				$this->position->getWorld()->setBlock($this->position, ExperimentalBlocks::fromString("lit_deepslate_redstone_ore"));
			}
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::REDSTONE_DUST()->setCount(mt_rand(4, 5))];
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
			protected function getXpDropAmount() : int{
				return mt_rand(1, 5);
			}
		};
	}
}