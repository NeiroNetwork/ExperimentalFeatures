<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\ToolTier;

class RawGoldBlock extends Feature implements IBlock, HasRecipe{

	public function recipe() : array{
		return [new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => ExperimentalItems::RAW_GOLD()], [ExperimentalBlocks::RAW_GOLD_BLOCK()->asItem()])];
	}

	public function networkId() : int{
		return -453;
	}

	public function name() : string{
		return "raw_gold_block";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(), "Raw Gold Block",
			new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)
		);
	}
}