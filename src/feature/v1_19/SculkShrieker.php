<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_19\sound\SculkShriekerShriekSound;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\block\utils\SupportType;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

class SculkShrieker extends Feature implements IBlock{

	public function stringId() : string{
		return "sculk_shrieker";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::HOE)
		) extends Transparent{
			private bool $active = false;
			private bool $canSummon = false;

			public function readStateFromData(int $id, int $stateMeta) : void{
				$this->active = ($stateMeta & 0b10) !== 0;
				$this->canSummon = ($stateMeta & 0b01) !== 0;
			}

			protected function writeStateToMeta() : int{
				return ($this->active ? 0b10 : 0) | ($this->canSummon ? 0b01 : 0);
			}

			public function getStateBitmask() : int{
				return 0b11;
			}

			public function getActive() : bool{
				return $this->active;
			}

			public function setActive(bool $active) : void{
				$this->active = $active;
			}

			public function getCanSummon() : bool{
				return $this->canSummon;
			}

			public function setCanSummon(bool $canSummon) : void{
				$this->canSummon = $canSummon;
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
				if(!$this->getActive()){
					$this->setActive(true);
					$this->position->world->setBlock($this->position, $this);
					$this->position->world->scheduleDelayedBlockUpdate($this->position, 90);
					$this->position->world->addSound($this->position, new SculkShriekerShriekSound());
					// TODO: add particle
				}
				return parent::onEntityLand($entity);
			}

			public function onScheduledUpdate() : void{
				if($this->getActive()){
					$this->setActive(false);
					$this->position->world->setBlock($this->position, $this);
				}
			}
		};
	}
}
