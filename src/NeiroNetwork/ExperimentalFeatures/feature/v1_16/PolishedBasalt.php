<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
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

class PolishedBasalt extends Feature implements IBlock,HasRecipe{

	public function networkId() : int{
		return -235;
	}

	public function name() : string{
		return "polished_basalt";
	}

	public function block() : Block{
		return new Opaque($this->blockId(),"Polished Basalt", new BlockBreakInfo(1.25, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 21.0));
	}

	public function recipe() : array{
		return [
			new ShapedRecipe(
				["AA","AA"], [
					"A" => ExperimentalBlocks::BASALT()->asItem()
				],
				[ExperimentalBlocks::POLISHED_BASALT()->asItem()->setCount(4)]
			)
		];
	}
}