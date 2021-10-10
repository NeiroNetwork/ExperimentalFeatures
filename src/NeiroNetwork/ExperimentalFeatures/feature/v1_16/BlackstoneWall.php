<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Wall;
use pocketmine\item\ToolTier;

class BlackstoneWall extends Feature implements IBlock{

	public function networkId() : int{
		return -277;
	}

	public function name() : string{
		return "blackstone_wall";
	}

	public function block() : Block{
		return new Wall($this->blockId(),"Blackstone Wall", new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0));
	}
}