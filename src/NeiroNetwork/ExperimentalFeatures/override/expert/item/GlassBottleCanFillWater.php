<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\item;

use pocketmine\block\Block;
use pocketmine\block\Water;
use pocketmine\item\GlassBottle;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class GlassBottleCanFillWater extends ItemOverrideExpert{

	protected function glass_bottle() : Item{
		$i = VanillaItems::GLASS_BOTTLE();
		return new class($this->toIdentifier($i), $i->getName()) extends GlassBottle{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				if($blockClicked instanceof Water){
					$stack = clone $this;
					$stack->pop();

					$waterPotion = VanillaItems::WATER_POTION();

					if($player->hasFiniteResources()){
						if($stack->getCount() === 0){
							$player->getInventory()->setItemInHand($waterPotion);
						}else{
							$player->getInventory()->setItemInHand($stack);
							$player->getInventory()->addItem($waterPotion);
						}
					}else{
						$player->getInventory()->addItem($waterPotion);
					}

					return ItemUseResult::SUCCESS();
				}

				return ItemUseResult::NONE();
			}
		};
	}
}