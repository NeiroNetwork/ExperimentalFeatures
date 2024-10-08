<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16\block;

use pocketmine\block\Block;
use pocketmine\block\Flower;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

// HACK: 植木鉢に入れられるのでFlowerを継承する
class Roots extends Flower{

	public function canBeReplaced() : bool{
		return true;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		// TODO: 置ける場所をより正確にする
		if(!$blockReplace->getSide(Facing::DOWN)->isTransparent()){
			return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
		}
		return false;
	}

	public function onNearbyBlockChange() : void{
		if($this->getSide(Facing::DOWN)->isTransparent()){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function getFlameEncouragement() : int{
		return parent::getFlameEncouragement(); // TODO: Change the autogenerated stub
	}

	public function getFlammability() : int{
		return 0;
	}
}
