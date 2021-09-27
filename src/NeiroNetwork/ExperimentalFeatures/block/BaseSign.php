<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use NeiroNetwork\ExperimentalFeatures\registry\tile\ExperimentalSign as TileSign;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItems;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

abstract class BaseSign extends \pocketmine\block\BaseSign{

	protected bool $glowing = false;

	public function readStateFromWorld() : void{
		parent::readStateFromWorld();
		$tile = $this->position->getWorld()->getTile($this->position);
		if($tile instanceof TileSign){
			$this->glowing = $tile->isGlowing();
		}
	}

	public function writeStateToWorld() : void{
		parent::writeStateToWorld();
		$tile = $this->position->getWorld()->getTile($this->position);
		assert($tile instanceof TileSign);
		$tile->setGlowing($this->glowing);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($item->equals(ExperimentalItems::GLOW_INK_SAC())){
			$item->pop();
			$this->setGlowing(true);
			$this->position->getWorld()->setBlock($this->position, $this);
			return true;
		}
		return false;
	}

	public function isGlowing() : bool{
		return $this->glowing;
	}

	public function setGlowing(bool $glowing) : void{
		$this->glowing = $glowing;
	}
}