<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalSign as TileSign;
use pocketmine\block\BaseSign;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

abstract class ExperimentalBaseSign extends BaseSign{

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
		$this->setGlowing(true);
		return parent::onInteract($item, $face, $clickVector, $player);
	}

	public function isGlowing() : bool{
		return $this->glowing;
	}

	public function setGlowing(bool $glowing) : void{
		$this->glowing = $glowing;
	}
}