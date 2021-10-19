<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;

class WeatheredCutCopper extends Feature implements IBlock{

	public function stringId() : string{
		return "weathered_cut_copper";
	}

	public function block() : Block{
		return new Opaque(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)
		);
	}
}