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

class AzaleaLeavesFlowered extends Feature implements IBlock{

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
				if(($item->getBlockToolType() & BlockToolType::SHEARS) !== 0){
					return parent::getDropsForCompatibleTool($item);
				}
				$drops = [];
				if(mt_rand(1, 20) === 1){
					$drops [] = ExperimentalBlocks::fromString("flowering_azalea")->asItem();
				}
				if(mt_rand(1, 50) === 1){
					$drops [] = VanillaItems::STICK();
				}
				return $drops;
			}
			public function blocksDirectSkyLight() : bool{
				return true;
			}
			public function isAffectedBySilkTouch() : bool{
				return true;
			}
			public function getFlameEncouragement() : int{
				return 30;
			}

			public function getFlammability() : int{
				return 60;
			}
		};
	}
}