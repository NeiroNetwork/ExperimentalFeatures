<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Flowable;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class WeepingVines extends Feature implements IBlock{

	public function stringId() : string{
		return "weeping_vines";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Flowable{
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($blockReplace->getSide(Facing::UP)->getId() !== BlockLegacyIds::AIR){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}
				return false;
			}

			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::UP)->getId() === BlockLegacyIds::AIR){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}

			public function getDropsForCompatibleTool(Item $item) : array{
				if(mt_rand(1, 3) === 1){
					return parent::getDropsForCompatibleTool($item);
				}
				return [];
			}

			public function hasEntityCollision() : bool{
				return true;
			}

			public function canClimb() : bool{
				return true;
			}

			public function onEntityInside(Entity $entity) : bool{
				$entity->resetFallDistance();
				return true;
			}
		};
	}
}