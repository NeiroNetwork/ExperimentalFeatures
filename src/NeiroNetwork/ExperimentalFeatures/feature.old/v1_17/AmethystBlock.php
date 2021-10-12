<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

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

class AmethystBlock extends Feature implements IBlock, HasRecipe{

	public function networkId() : int{
		return -327;
	}

	public function name() : string{
		return "amethyst_block";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(), "Amethyst Block",
			new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())
		);
	}

	public function recipe() : array{
		return [new ShapedRecipe(["AA", "AA"], ["A" => ExperimentalItems::AMETHYST_SHARD()], [ExperimentalBlocks::AMETHYST_BLOCK()->asItem()])];
	}
}