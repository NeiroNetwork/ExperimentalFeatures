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

class PolishedBlackstoneWall extends Feature implements IBlock{

	public function networkId() : int{
		return -297;
	}

	public function name() : string{
		return "polished_blackstone_wall";
	}

	public function block() : Block{
		return new Wall($this->blockId(),"Polished Blackstone Wall", new BlockBreakInfo(2.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0));
	}
}{

}