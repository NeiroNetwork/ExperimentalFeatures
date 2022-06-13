<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class ReinforcedDeepslate extends Feature implements IBlock{

	public function stringId() : string{
		return "reinforced_deepslate";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(55.0, blastResistance: 6000.0)
		) extends Opaque{
			public function getDrops(Item $item) : array{
				return [];
			}
		};
	}
}
