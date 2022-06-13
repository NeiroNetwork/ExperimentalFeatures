<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16\block;

use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

abstract class Vines extends Flowable{

	abstract protected function hasSupportBlock() : bool;

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($this->hasSupportBlock($blockReplace)){
			return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
		}
		return false;
	}

	public function onNearbyBlockChange() : void{
		if(!$this->hasSupportBlock($this)){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		if(mt_rand(1, 3) === 1){
			return parent::getDropsForCompatibleTool($item);
		}
		return [];
	}

	public function hasEntityCollision() : bool{
		return true;
	}

	public function canClimb() : bool{
		return true;
	}

	public function onEntityInside(Entity $entity) : bool{
		$entity->resetFallDistance();
		return true;
	}
}
