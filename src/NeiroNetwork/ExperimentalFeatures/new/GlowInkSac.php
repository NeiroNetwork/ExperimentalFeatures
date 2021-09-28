<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\override\SignTile;
use pocketmine\block\BaseSign;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class GlowInkSac extends Feature implements IItem{

	public function networkId() : int{
		return 503;
	}

	public function name() : string{
		return "glow_ink_sac";
	}

	public function item() : Item{
		// BaseSignをオーバーライドするのはとてもめんどくさいのでアイテム側で実装する
		return new class(new ItemIdentifier($this->internalId(), 0), "Glow Ink Sac") extends Item{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				if(!$player->isSneaking() && !$player->isAdventure() && $blockClicked instanceof BaseSign){
					$tile = $player->getWorld()->getTile($blockClicked->getPosition());
					if($tile instanceof SignTile && !$tile->isGlowing()){
						$tile->setGlowing(true);
						$player->getWorld()->setBlock($blockClicked->getPosition(), $blockClicked);
						if($player->hasFiniteResources()){
							$stack = clone $this;
							$stack->pop();
							$player->getInventory()->setItemInHand($stack);
						}
						return ItemUseResult::SUCCESS();
					}
				}
				return ItemUseResult::NONE();
			}
		};
	}
}