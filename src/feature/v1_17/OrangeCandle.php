<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_17\block\BaseCandle;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;

class OrangeCandle extends Feature implements IBlock{

	public function stringId() : string{
		return "orange_candle";
	}

	public function block() : Block{
		return new BaseCandle(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.1)
		);
	}
}
