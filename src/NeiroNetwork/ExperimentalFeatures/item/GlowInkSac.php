<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalSign;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class GlowInkSac extends Item{

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		$tile = $blockClicked->getPosition()->getWorld()->getTile($blockClicked->getPosition());
		if($tile instanceof ExperimentalSign){
			$stack = clone $this;
			$stack->pop();

			$tile->setGlowing(true);

			// TODO: call event

			return ItemUseResult::SUCCESS();
		}
		return ItemUseResult::NONE();
	}
}