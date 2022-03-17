<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_18;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Flowable;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class SporeBlossom extends Feature implements IBlock{

	public function stringId() : string{
		return "spore_blossom";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Flowable{
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($blockReplace->getSide(Facing::UP)->isSolid()){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}
				return false;
			}

			public function onNearbyBlockChange() : void{
				if(!$this->getSide(Facing::UP)->isSolid()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}

			public function getFlameEncouragement() : int{
				return parent::getFlameEncouragement(); // TODO: Change the autogenerated stub
			}

			public function getFlammability() : int{
				return parent::getFlammability(); // TODO: Change the autogenerated stub
			}
		};
	}
}