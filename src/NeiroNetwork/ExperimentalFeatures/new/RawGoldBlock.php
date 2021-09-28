<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\Craftable;
use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\crafting\CraftingRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;

class RawGoldBlock implements IBlock, Craftable{

	public function recipe() : CraftingRecipe{
		return new ShapelessRecipe([ExperimentalBlocks::RAW_GOLD_BLOCK()->asItem()], [ExperimentalItems::RAW_GOLD()->setCount(9)]);
	}

	public function internalId() : int{
		return 604;
	}

	public function networkId() : int{
		return -453;
	}

	public function name() : string{
		return "raw_gold_block";
	}

	public function block() : Block{
		return new Opaque(
			new BlockIdentifier($this->internalId(), 0, $this->internalId()),
			"Raw Gold Block",
			new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)
		);
	}
}