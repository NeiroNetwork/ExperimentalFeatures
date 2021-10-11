<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class CobbledDeepslate extends Feature implements IBlock, Smeltable, HasRecipe{

	public function networkId() : int{
		return -379;
	}

	public function name() : string{
		return "cobbled_deepslate";
	}

	public function block() : Block{
		return new class(
			$this->blockId(), "CobbledDeepslate",
			new BlockBreakInfo(3.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		) extends Opaque{
		};
	}
	public function recipe() : array{
		return [new FurnaceRecipe(ExperimentalBlocks::Deepslate()->asItem(), ExperimentalBlocks::COBBLED_DEEPSLATE()->asItem())];

	}

}