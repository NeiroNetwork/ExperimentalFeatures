<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\block\Block;
use pocketmine\block\Dirt;
use pocketmine\block\Farmland;
use pocketmine\block\Flowable;
use pocketmine\block\Grass;
use pocketmine\block\Podzol;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class Sapling extends Flowable{

	private function canBeSupportedBy(Block $block) : bool{
		return
			$block instanceof Dirt ||
			$block instanceof Grass ||
			$block instanceof Podzol ||
			$block instanceof Farmland;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($this->canBeSupportedBy($this->getSide(Facing::DOWN))){
			return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
		}

		return false;
	}

	public function onNearbyBlockChange() : void{
		if(!$this->canBeSupportedBy($this->getSide(Facing::DOWN))){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function getFuelTime() : int{
		return 100;
	}
}
