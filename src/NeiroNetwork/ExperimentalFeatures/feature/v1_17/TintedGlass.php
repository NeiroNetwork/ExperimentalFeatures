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
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\ShapedRecipe;

class TintedGlass extends Feature implements IBlock,HasRecipe{

	public function networkId() : int{
		return -334;
	}

	public function name() : string{
		return "tinted_glass";
	}

	public function block() : Block{
		return new Opaque($this->blockId(),"Tinted Glass", new BlockBreakInfo(0.3));
	}

	public function recipe() : array{
		return [
			new ShapedRecipe(
				[" A ", "ABA"," A "],
				[
					"A" => ExperimentalItems::AMETHYST_SHARD(),
					"B" => VanillaBlocks::GLASS()->asItem()
				],
				[ExperimentalBlocks::TINTED_GLASS()->asItem()->setCount(2)]
			)
		];
	}
}