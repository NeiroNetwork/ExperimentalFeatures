<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class Sculk extends Feature implements IBlock{

	public function stringId() : string{
		return "sculk";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.6, BlockToolType::HOE, 0, 1.0)
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{ return []; }
			protected function getXpDropAmount() : int{ return 1; }
			public function isAffectedBySilkTouch() : bool{ return true; }
		};
	}
}
