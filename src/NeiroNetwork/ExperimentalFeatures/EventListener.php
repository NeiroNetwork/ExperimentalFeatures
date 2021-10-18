<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use pocketmine\block\Fire;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\world\sound\FireExtinguishSound;

class EventListener implements Listener{

	/**
	 * FIXME: どうしようも出来なかったのでイベントで魂の炎を消すようにする
	 * @priority MONITOR
	 */
	public function onInteract(PlayerInteractEvent $event) : void{
		if($event->getAction() === PlayerInteractEvent::LEFT_CLICK_BLOCK
			&& ($block = $event->getBlock()->getSide($event->getFace())) instanceof Fire){
			$world = $block->getPosition()->getWorld();
			$world->setBlock($block->getPosition(), VanillaBlocks::AIR());
			$world->addSound($block->getPosition()->add(0.5, 0.5, 0.5), new FireExtinguishSound());
		}
	}
}