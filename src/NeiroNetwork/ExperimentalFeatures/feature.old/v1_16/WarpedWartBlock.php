<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;

class WarpedWartBlock extends Feature implements IBlock{

	public function networkId() : int{
		return -227;
	}

	public function name() : string{
		return "warped_wart_block";
	}

	public function block() : Block{
		return new Opaque($this->blockId(), "Warped Wart Block", new BlockBreakInfo(1.0, BlockToolType::HOE));
	}
}