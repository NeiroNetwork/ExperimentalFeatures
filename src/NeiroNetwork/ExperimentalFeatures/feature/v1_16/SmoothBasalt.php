<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\item\ToolTier;

class SmoothBasalt extends Feature implements IBlock, Smeltable,HasRecipe{

	public function networkId() : int{
		return -377;
	}

	public function name() : string{
		return "smooth_basalt";
	}

	public function block() : Block{

		return new Opaque($this->blockId(), "Smooth Basalt",
			new BlockBreakInfo(1.25, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 21.0));
	}


	public function recipe() : array{
		return [
			new FurnaceRecipe(ExperimentalBlocks::SMOOTH_BASALT()->asItem(), ExperimentalBlocks::BASALT()->asItem())
		];
	}
}
