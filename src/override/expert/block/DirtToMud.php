<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use NeiroNetwork\ExperimentalFeatures\feature\v1_19\sound\SplashSound;
use pocketmine\block\Block;
use pocketmine\block\Dirt;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\Potion;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class DirtToMud extends BlockOverrideExpert{

	protected function dirt() : Block{
		$b = VanillaBlocks::DIRT();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Dirt{

			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($item instanceof Potion && $item->getType()->equals(PotionType::WATER())){
					if($player?->hasFiniteResources()) $player->getInventory()->setItemInHand(VanillaItems::AIR());
					$player?->getInventory()->addItem(VanillaItems::GLASS_BOTTLE());
					$this->position->getWorld()->addSound($this->position, new SplashSound());
					$this->position->getWorld()->setBlock($this->position, VanillaBlocks::mud());
					return true;
				}

				return parent::onInteract($item, $face, $clickVector, $player);
			}
		};
	}
}
