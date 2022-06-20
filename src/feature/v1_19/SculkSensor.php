<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\block\utils\SupportType;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

class SculkSensor extends Feature implements IBlock{

	public function stringId() : string{
		return "sculk_sensor";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(1.5, BlockToolType::HOE)
		) extends Transparent{
			private bool $powered = false;

			public function readStateFromData(int $id, int $stateMeta) : void{
				$this->powered = ($stateMeta & 0b1) !== 0;
			}

			protected function writeStateToMeta() : int{
				return $this->powered ? 0b1 : 0;
			}

			public function getStateBitmask() : int{
				return 0b1;
			}

			public function getPowered() : bool{
				return $this->powered;
			}

			public function setPowered(bool $powered) : void{
				$this->powered = $powered;
			}

			public function getDropsForCompatibleTool(Item $item) : array{
				return [];
			}

			protected function getXpDropAmount() : int{
				return 5;
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}

			protected function recalculateCollisionBoxes() : array{
				return [AxisAlignedBB::one()->trim(Facing::UP, 8 / 16)];
			}

			public function getSupportType(int $facing) : SupportType{
				return $facing === Facing::DOWN ? SupportType::FULL() : SupportType::NONE();
			}

			public function onEntityLand(Entity $entity) : ?float{
				// TODO: エンティティの移動も感知する(重そう)
				$this->activate();
				return null;
			}

			public function onNearbyBlockChange() : void{
				// TODO: もっと広い範囲を感知する(重そう)
				$this->activate();
			}

			private function activate() : void{
				if(!$this->getPowered()){
					$this->setPowered(true);
					$this->position->world->setBlock($this->position, $this);
					$this->position->world->scheduleDelayedBlockUpdate($this->position, 40);
					// TODO: play sound
				}
			}

			public function onScheduledUpdate() : void{
				if($this->getPowered()){
					$this->setPowered(false);
					$this->position->world->setBlock($this->position, $this);
				}
			}
		};
	}
}
