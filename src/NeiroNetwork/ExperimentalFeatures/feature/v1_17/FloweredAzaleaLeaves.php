<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class FloweredAzaleaLeaves extends Feature implements IBlock{

	public function stringId() : string{
		return "azalea_leaves_flowered";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.2, BlockToolType::HOE)
		) extends Transparent{
			public function getDropsForCompatibleTool(Item $item) : array{
				$drops = [];
				if(mt_rand(1, 20) === 1){
					$drops [] = ExperimentalBlocks::fromString("azalea_leaves_flowered")->asItem();
				}
				if(mt_rand(1, 50) === 1){
					$drops [] = VanillaItems::STICK();
				}
				return $drops;
			}
		};
	}
}