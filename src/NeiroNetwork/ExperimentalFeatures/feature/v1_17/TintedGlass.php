<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\ShapedRecipe;

class TintedGlass extends Feature implements IBlock, HasRecipe{

	public function stringId() : string{
		return "tinted_glass";
	}

	public function block() : Block{
		return new Transparent(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.3)
		);
	}

	public function recipe() : array{
		return [
			new ShapedRecipe(
				[" A ", "ABA", " A "],
				[
					"A" => ExperimentalItems::fromString("amethyst_shard"),
					"B" => VanillaBlocks::GLASS()->asItem()
				],
				[ExperimentalBlocks::fromString("tinted_glass")->asItem()->setCount(2)]
			)
		];
	}
}