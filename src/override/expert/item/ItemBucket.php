<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\item;

use pocketmine\block\Block;
use pocketmine\block\Liquid;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\player\PlayerBucketFillEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\item\Bucket;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class ItemBucket extends ItemOverrideExpert{

	protected function bucket() : Item{
		$i = VanillaItems::BUCKET();
		return new class($this->toIdentifier($i), $i->getName()) extends Bucket{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				if($blockClicked instanceof Liquid && $blockClicked->isSource()){
					$resultItem = ItemFactory::getInstance()->get(ItemIds::BUCKET, $blockClicked->getFlowingForm()->getId());
					$ev = new PlayerBucketFillEvent($player, $blockReplace, $face, $this, $resultItem);
					$ev->call();
					if($ev->isCancelled()){
						return ItemUseResult::FAIL();
					}

					if($player->hasFiniteResources()){
						$stack = clone $this;
						$stack->pop();
						if($stack->getCount() === 0){
							$player->getInventory()->setItemInHand($ev->getItem());
						}else{
							foreach($player->getInventory()->addItem($ev->getItem()) as $overflow){
								$dropEv = new PlayerDropItemEvent($player, $overflow);
								$dropEv->call();
								if($dropEv->isCancelled()){
									return ItemUseResult::FAIL();
								}
								$player->dropItem($overflow);
							}
							$player->getInventory()->setItemInHand($stack);
						}
					}else{
						$player->getInventory()->addItem($ev->getItem());
					}

					$player->getWorld()->setBlock($blockClicked->getPosition(), VanillaBlocks::AIR());
					$player->getWorld()->addSound($blockClicked->getPosition()->add(0.5, 0.5, 0.5), $blockClicked->getBucketFillSound());

					return ItemUseResult::SUCCESS();
				}

				return ItemUseResult::NONE();
			}
		};
	}
}