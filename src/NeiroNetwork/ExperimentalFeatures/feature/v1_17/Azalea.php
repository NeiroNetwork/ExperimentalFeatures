<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class Azalea extends Feature implements IBlock{

	public function stringId() : string{
		return "azalea";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Transparent{
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				$down = $this->getSide(Facing::DOWN);
				if($down->getId() === BlockLegacyIds::GRASS or $down->getId() === BlockLegacyIds::DIRT or $down->getId() === BlockLegacyIds::FARMLAND){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}

				return false;
			}

			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::DOWN)->isTransparent()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}

			public function getFuelTime() : int{
				return 100;
			}
		};
	}
}