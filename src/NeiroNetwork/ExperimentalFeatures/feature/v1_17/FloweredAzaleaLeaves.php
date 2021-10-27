<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\Transparent;
use pocketmine\item\ToolTier;

class FloweredAzaleaLeaves extends Feature implements IBlock{

	public function stringId() : string{
		return "azalea_leaves_flowered";
	}

	public function block() : Block{
		return new Transparent(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.2, BlockToolType::HOE)
		);
	}
}