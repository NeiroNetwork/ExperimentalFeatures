<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\EmeraldOre;
use pocketmine\item\ToolTier;

class DeepslateEmeraldOre extends Feature implements IBlock{

	public function stringId() : string{
		return "deepslate_emerald_ore";
	}

	public function block() : Block{
		return new EmeraldOre(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(4.5, BlockToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)
		);
	}
}
