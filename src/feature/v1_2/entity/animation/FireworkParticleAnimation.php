<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\animation;

use NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\FireworksRocket;
use pocketmine\entity\animation\Animation;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\types\ActorEvent;

final class FireworkParticleAnimation implements Animation{

	public function __construct(private FireworksRocket $entity){}

	public function encode() : array{
		return [ActorEventPacket::create($this->entity->getId(), ActorEvent::FIREWORK_PARTICLES, 0)];
	}
}
