<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity;

use NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\animation\FireworkParticleAnimation;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\item\Fireworks;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\item\FireworkType;
use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;

class FireworksRocket extends Entity{

	public static function getNetworkTypeId() : string{
		return EntityIds::FIREWORKS_ROCKET;
	}

	protected CompoundTag $fireworksNbt;
	protected int $lifeTime = 0;

	protected function getInitialSizeInfo() : EntitySizeInfo{
		return new EntitySizeInfo(0.25, 0.25);
	}

	public function __construct(Location $location, ?Fireworks $fireworks, ?CompoundTag $nbt = null){
		parent::__construct($location, $nbt);
		if(!is_null($fireworks)){
			$this->fireworksNbt = $fireworks->getNamedTag();
			$this->lifeTime = $fireworks->getRandomizedFlightDuration();
		}
	}

	protected function initEntity(CompoundTag $nbt) : void{
		parent::initEntity($nbt);
		if(!isset($this->fireworksNbt)){
			$this->fireworksNbt = $nbt->getCompoundTag("fireworksNbt") ?? CompoundTag::create();
		}
		$this->lifeTime = $nbt->getShort("lifeTime", $this->lifeTime);
	}

	public function saveNBT() : CompoundTag{
		$nbt = parent::saveNBT();
		$nbt->setTag("fireworksNbt", $this->fireworksNbt);
		$nbt->setShort("lifeTime", $this->lifeTime);
		return $nbt;
	}

	protected function tryChangeMovement() : void{
		$this->motion->x *= 1.15;
		$this->motion->y += 0.04;
		$this->motion->z *= 1.15;
	}

	protected function entityBaseTick(int $tickDiff = 1) : bool{
		if($this->closed){
			return false;
		}

		$hasUpdate = parent::entityBaseTick($tickDiff);

		if(--$this->lifeTime < 0 && !$this->isFlaggedForDespawn()){
			$this->broadcastAnimation(new FireworkParticleAnimation($this), $this->getViewers());
			$this->playSounds();
			$this->flagForDespawn();
			return true;
		}

		return $hasUpdate;
	}

	protected function playSounds() : void{
		$explosions = $this->fireworksNbt->getCompoundTag("Fireworks")?->getListTag("Explosions");
		if(is_null($explosions)){
			return;
		}

		foreach($explosions->getValue() as $tag){
			if($tag instanceof CompoundTag){
				$sound = $tag->getByte("FireworkType", 0) === FireworkType::HUGE_SPHERE()->getMagicNumber() ? LevelSoundEvent::LARGE_BLAST : LevelSoundEvent::BLAST;
				$this->getWorld()->broadcastPacketToViewers($this->location, LevelSoundEventPacket::nonActorSound($sound, $this->location, false));
				if($tag->getByte("FireworkFlicker", 0) === 1){
					$this->getWorld()->broadcastPacketToViewers($this->location, LevelSoundEventPacket::nonActorSound(LevelSoundEvent::TWINKLE, $this->location, false));
				}
			}
		}
	}

	protected function syncNetworkData(EntityMetadataCollection $properties) : void{
		parent::syncNetworkData($properties);
		$properties->setCompoundTag(16, new CacheableNbt($this->fireworksNbt));
	}
}