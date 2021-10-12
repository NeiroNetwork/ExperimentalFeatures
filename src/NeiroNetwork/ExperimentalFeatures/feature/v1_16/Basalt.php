<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;

class Basalt extends Feature implements IBlock{

	public function networkId() : int{
		return -234;
	}

	public function name() : string{
		return "basalt";
	}

	public function block() : Block{
		return new Opaque($this->blockId(), "Basalt", new BlockBreakInfo(1.25, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 21.0));
	}
}