<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_11\block;

use pocketmine\block\Transparent;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\NormalHorizontalFacingInMetadataTrait;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class BaseCampfire extends Transparent{
	use FacesOppositePlacingPlayerTrait;
	use NormalHorizontalFacingInMetadataTrait;

	protected bool $extinguished = true;

	protected function writeStateToMeta() : int{
		return BlockDataSerializer::writeLegacyHorizontalFacing($this->facing) | ($this->extinguished ? 0b100 : 0);
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->facing = BlockDataSerializer::readLegacyHorizontalFacing($stateMeta & 0b011);
		$this->extinguished = ($stateMeta & 0b100) !== 0;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		$this->extinguished = !$this->extinguished;
		$this->position->getWorld()->setBlock($this->position, $this);
		return true;
	}
}