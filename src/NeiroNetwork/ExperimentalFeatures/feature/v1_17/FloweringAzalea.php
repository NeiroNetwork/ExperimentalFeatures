<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;
use pocketmine\item\Item;

class FloweringAzalea extends Feature implements IBlock{

	public function stringId() : string{
		return "flowering_azalea";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Transparent{
			public function getDropsForCompatibleTool(Item $item) : array{
				if(mt_rand(1, 20) === 1){
					return [ExperimentalBlocks::fromString("flowering_azalea")->asItem()];
				}
				return [];
			}
		};
	}
}