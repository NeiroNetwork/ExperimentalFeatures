<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_11\block;

use pocketmine\block\Transparent;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\NormalHorizontalFacingInMetadataTrait;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityCombustByBlockEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Durable;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\FlintSteel;
use pocketmine\item\Item;
use pocketmine\item\Shovel;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\FireExtinguishSound;
use pocketmine\world\sound\FlintSteelSound;

class BaseCampfire extends Transparent{
	use FacesOppositePlacingPlayerTrait;
	use NormalHorizontalFacingInMetadataTrait;

	protected bool $extinguished = false;

	protected function writeStateToMeta() : int{
		return BlockDataSerializer::writeLegacyHorizontalFacing($this->facing) | ($this->extinguished ? 0b100 : 0);
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->facing = BlockDataSerializer::readLegacyHorizontalFacing($stateMeta & 0b011);
		$this->extinguished = ($stateMeta & 0b100) !== 0;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if(!$this->extinguished && $item instanceof Shovel){
			$item->applyDamage(1);
			$this->extinguished = true;
			$this->position->world->setBlock($this->position, $this);
			$this->position->world->addSound($this->position->add(0.5, 0.5, 0.5), new FireExtinguishSound());
			return true;
		}elseif($this->extinguished && ($item instanceof FlintSteel || $item->hasEnchantment(VanillaEnchantments::FIRE_ASPECT()))){
			if($item instanceof Durable){
				$item->applyDamage(1);
			}
			$this->extinguished = false;
			$this->position->world->setBlock($this->position, $this);
			$this->position->world->addSound($this->position->add(0.5, 0.5, 0.5), new FlintSteelSound());
			return true;
		}
		return false;
	}

	protected function recalculateCollisionBoxes() : array{
		return [AxisAlignedBB::one()->trim(Facing::UP, 9 / 16)];
	}

	public function getLightLevel() : int{
		return 15;
	}

	public function hasEntityCollision() : bool{
		return true;
	}

	public function onEntityInside(Entity $entity) : bool{
		if(!$this->extinguished){
			$ev = new EntityDamageByBlockEvent($this, $entity, EntityDamageEvent::CAUSE_FIRE, 1);
			$entity->attack($ev);

			$ev = new EntityCombustByBlockEvent($this, $entity, 8);
			$ev->call();
			if(!$ev->isCancelled()){
				$entity->setOnFire($ev->getDuration());
			}
		}
		return true;
	}
}