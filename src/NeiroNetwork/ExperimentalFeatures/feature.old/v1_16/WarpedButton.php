<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\WoodenButton;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class WarpedButton extends Feature implements IBlock{

	public function networkId() : int{
		return -261;
	}

	public function name() : string{
		return "warped_button";
	}

	public function block() : Block{
		return new class($this->blockId(), "Warped Button", new BlockBreakInfo(0.5, BlockToolType::AXE)) extends WoodenButton{
			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				return true;
			}
		};
	}
}