<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;
use pocketmine\entity\Entity;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;

class HoneyBlock extends Feature implements IBlock{

	public function stringId() : string{
		return "honey_block";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Transparent{
			protected function recalculateCollisionBoxes() : array{
				return [
					AxisAlignedBB::one()
						->squash(Axis::X, 1 / 16)
						->squash(Axis::Z, 1 / 16)
				];
			}

			public function onEntityInside(Entity $entity) : bool{
				$entity->resetFallDistance();
				return true;
			}

			public function hasEntityCollision() : bool{
				return true;
			}
		};
	}
}