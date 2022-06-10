<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Flowable;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class FrogSpawn extends Feature implements IBlock{

	public function stringId() : string{
		return "frog_spawn";
	}

	public function block() : Block{
		return new class($this->blockId(), $this->displayName(), BlockBreakInfo::instant()) extends Flowable{
			public function getDrops(Item $item) : array{
				return [];
			}

			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($blockClicked->isSameState(VanillaBlocks::WATER())){
					$up = $blockClicked->getSide(Facing::UP);
					if($up->canBeReplaced()){	// TODO: これでいいか分からない
						return parent::place($tx, $item, $up, $blockClicked, $face, $clickVector, $player);
					}
				}
				return false;
			}

			public function onNearbyBlockChange() : void{
				if(!$this->getSide(Facing::DOWN)->isSameState(VanillaBlocks::WATER())){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}
}