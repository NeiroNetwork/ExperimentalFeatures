<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\ToolTier;

class RawIronBlock extends Feature implements IBlock, HasRecipe{

	public function recipe() : array{
		return [new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_IRON()], [ExperimentalBlocks::RAW_IRON_BLOCK()->asItem()])];
	}

	public function networkId() : int{
		return -451;
	}

	public function name() : string{
		return "raw_iron_block";
	}

	public function block() : Block{
		return new Opaque($this->blockId(), "Raw Iron Block",
			new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		);
	}
}