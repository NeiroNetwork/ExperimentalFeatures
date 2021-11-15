<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Flowable;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class Sapling extends Flowable{

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		$down = $this->getSide(Facing::DOWN);
		if($down->getId() === BlockLegacyIds::GRASS or $down->getId() === BlockLegacyIds::DIRT or $down->getId() === BlockLegacyIds::FARMLAND){
			return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
		}

		return false;
	}

	public function onNearbyBlockChange() : void{
		$down = $this->getSide(Facing::DOWN);
		if($down->getId() !== BlockLegacyIds::GRASS and $down->getId() !== BlockLegacyIds::DIRT and $down->getId() !== BlockLegacyIds::FARMLAND){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function getFuelTime() : int{
		return 100;
	}
}