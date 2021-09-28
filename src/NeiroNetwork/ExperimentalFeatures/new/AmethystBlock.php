<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;

class AmethystBlock extends Feature implements IBlock{

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
}