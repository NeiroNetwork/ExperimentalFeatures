<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;

class FloweringAzalea extends Feature implements IBlock{

	public function stringId() : string{
		return "flowering_azalea";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0)
		) extends Transparent{
			public function getDropsForCompatibleTool(Item $item) : array{
				if(mt_rand(1, 20) === 1){
					return [ExperimentalItems::FLOWERING_AZALEA()];
				}
				return [];
			}
		};
	}
}