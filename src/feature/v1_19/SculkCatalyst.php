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

class SculkCatalyst extends Feature implements IBlock{

	public function stringId() : string{
		return "sculk_catalyst";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::HOE)
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{ return []; }
			protected function getXpDropAmount() : int{ return 20; }
			public function isAffectedBySilkTouch() : bool{ return true; }
			public function getLightLevel() : int{ return 6; }
		};
	}
}
