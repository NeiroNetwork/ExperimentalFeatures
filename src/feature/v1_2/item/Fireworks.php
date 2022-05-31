<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2\item;

use NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\FireworksRocket;
use pocketmine\block\Block;
use pocketmine\entity\Location;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\player\Player;

class Fireworks extends Item{

	public function getFlightDuration() : int{
		return $this->getFireworksTag()->getByte("Flight", 1);
	}

	public function setFlightDuration(int $duration) : void{
		$this->getFireworksTag()->setByte("Flight", $duration);
	}

	public function getRandomizedFlightDuration() : int{
		return ($this->getFlightDuration() + 1) * 10 + mt_rand(0, 5) + mt_rand(0, 6);
	}

	public function addExplosion(FireworkType $type, FireworkColor $color, ?FireworkColor $fade = null, bool $flicker = false, bool $trail = false) : void{
		$this->getExplosionsTag()->push(CompoundTag::create()
			->setByte("FireworkType", $type->getMagicNumber())
			->setByteArray("FireworkColor", $color->getMagicChar())
			->setByteArray("FireworkFade", $fade?->getMagicChar() ?? "")
			->setByte("FireworkFlicker", (int) $flicker)
			->setByte("FireworkTrail", (int) $trail)
		);
	}

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		$vector = $blockReplace->getPosition()->addVector($clickVector)->add(0, -1, 0);
		$entity = new FireworksRocket(Location::fromObject($vector, $player->getWorld(), lcg_value() * 360, 90), $this);
		$entity->setMotion(new Vector3(0.001, 0.05, 0.001));
		$entity->spawnToAll();
		$entity->getWorld()->broadcastPacketToViewers($entity->getPosition(), LevelSoundEventPacket::nonActorSound(LevelSoundEvent::LAUNCH, $entity->getPosition(), false));

		$this->pop();

		return ItemUseResult::SUCCESS();
	}

	protected function getFireworksTag() : CompoundTag{
		$tag = $this->getNamedTag()->getCompoundTag("Fireworks");
		if($tag === null){
			$this->getNamedTag()->setTag("Fireworks", $tag = CompoundTag::create());
		}
		return $tag;
	}

	protected function getExplosionsTag() : ListTag{
		$tag = $this->getFireworksTag()->getListTag("Explosions");
		if($tag === null){
			$this->getFireworksTag()->setTag("Explosions", $tag = new ListTag());
		}
		return $tag;
	}
}