<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\block\Leaves;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;

class MangroveLeaves extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_leaves";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.2, BlockToolType::HOE)
		) extends Leaves{
			protected function getSapling() : Item{
				return VanillaBlocks::mangrove_propagule()->asItem();
			}
		};
	}
}
