<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_14\block\BaseBeehive;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;

class Beehive extends Feature implements IBlock{

	public function stringId() : string{
		return "beehive";
	}

	public function block() : Block{
		// FIXME: 今のところ、養蜂箱はメタ値0~15の範囲に蜜が溜まった状態が存在しない
		return new BaseBeehive(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.6, BlockToolType::AXE)
		);
	}
}