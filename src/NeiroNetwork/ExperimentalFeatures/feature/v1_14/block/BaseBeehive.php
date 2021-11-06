<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14\block;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Opaque;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\NormalHorizontalFacingInMetadataTrait;
use pocketmine\item\GlassBottle;
use pocketmine\item\Item;
use pocketmine\item\Shears;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\BucketFillWaterSound;

class BaseBeehive extends Opaque{
	use FacesOppositePlacingPlayerTrait;
	use NormalHorizontalFacingInMetadataTrait;

	protected bool $fulledHoney = false;

	protected function writeStateToMeta() : int{
		return BlockDataSerializer::writeLegacyHorizontalFacing($this->facing) | ($this->fulledHoney ? 0b100 : 0);
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->facing = BlockDataSerializer::readLegacyHorizontalFacing($stateMeta & 0b011);
		$this->fulledHoney = ($stateMeta & 0b100) !== 0;
	}

	public function getFulledHoney() : bool{
		return $this->fulledHoney;
	}

	public function setFulledHoney(bool $fulledHoney) : void{
		$this->fulledHoney = $fulledHoney;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($this->fulledHoney && $item instanceof Shears){
			$item->applyDamage(1);
			$this->fulledHoney = false;
			$this->position->world->setBlock($this->position, $this);
			// TODO: play sound
			$this->position->world->dropItem($this->position->add(0.5, 0.5, 0.5), ExperimentalItems::HONEYCOMB()->setCount(3));
			return true;
		}elseif($this->fulledHoney && $item instanceof GlassBottle){
			$this->fulledHoney = false;
			$this->position->world->setBlock($this->position, $this);
			$this->position->world->addSound($this->position->add(0.5, 0.5, 0.5), new BucketFillWaterSound());	//TODO: サウンドが正しいか分からない
			if($player?->hasFiniteResources()){
				$item->pop();
				if($item->getCount() === 0){
					$player?->getInventory()->setItemInHand(ExperimentalItems::HONEY_BOTTLE());
				}else{
					$player?->getInventory()->addItem(ExperimentalItems::HONEY_BOTTLE());
				}
			}else{
				$player?->getInventory()->addItem(ExperimentalItems::HONEY_BOTTLE());
			}
			return true;
		}

		return false;
	}
}