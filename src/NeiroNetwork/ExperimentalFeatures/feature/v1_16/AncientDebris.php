<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;

class AncientDebris extends Feature implements IBlock{

	public function stringId() : string{
		return "ancient_debris";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(30.0, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel(), 6000.0)
		);
	}
}

