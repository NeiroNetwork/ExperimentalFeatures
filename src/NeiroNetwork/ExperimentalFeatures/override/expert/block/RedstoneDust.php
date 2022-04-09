<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use pocketmine\block\Block;
use pocketmine\block\RedstoneWire;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class RedstoneDust extends BlockOverrideExpert{

	/**
	 * レッドストーンを積み重ねて置けないように、下のブロックが壊れたら壊れるように
	 */
	protected function redstone_wire() : Block{
		$b = VanillaBlocks::REDSTONE_WIRE();
		return $b;
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends RedstoneWire{
			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::DOWN)->isTransparent()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}

			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if(!$blockReplace->getSide(Facing::DOWN)->isTransparent()){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}

				return false;
			}
		};
	}
}