<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Stair;
use pocketmine\item\ToolTier;

class PolishedBlackstoneStairs extends Feature implements IBlock{

	public function networkId() : int{
		return -292;
	}

	public function name() : string{
		return "polished_blackstone_stairs";
	}

	public function block() : Block{
		return new Stair($this->blockId(),"Polished Blackstone stairs", new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0));
	}
}{

}