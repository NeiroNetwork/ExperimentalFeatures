<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Wall;
use pocketmine\item\ToolTier;

class DeepslateTileWall extends Feature implements IBlock{

	public function stringId() : string{
		return "deepslate_tile_wall";
	}

	public function block() : Block{
		return new Wall(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)
		);
	}
}
