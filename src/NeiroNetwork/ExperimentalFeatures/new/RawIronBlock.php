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
use pocketmine\item\ToolTier;

class RawIronBlock implements IBlock, Craftable{

	public function recipe() : CraftingRecipe{
		return new ShapelessRecipe([ExperimentalBlocks::RAW_IRON_BLOCK()->asItem()], [ExperimentalItems::RAW_IRON()->setCount(9)]);
	}

	public function internalId() : int{
		return 603;
	}

	public function networkId() : int{
		return -451;
	}

	public function name() : string{
		return "raw_iron_block";
	}

	public function block() : Block{
		return new Opaque(
			new BlockIdentifier($this->internalId(), 0, $this->internalId()),
			"Raw Iron Block",
			new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		);
	}
}