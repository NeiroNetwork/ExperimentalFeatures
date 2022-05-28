<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Flowable;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class MossCarpet extends Feature implements IBlock{

	public function stringId() : string{
		return "moss_carpet";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.1)
		) extends Flowable{
			public function isSolid() : bool{
				return true;
			}

			protected function recalculateCollisionBoxes() : array{
				return [AxisAlignedBB::one()->trim(Facing::UP, 15 / 16)];
			}

			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				$down = $this->getSide(Facing::DOWN);
				if($down->getId() !== BlockLegacyIds::AIR){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}
				return false;
			}

			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::DOWN)->getId() === BlockLegacyIds::AIR){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}
}