<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\sound\RespawnAnchorChargeSound;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class RespawnAnchor extends Feature implements IBlock{

	public function stringId() : string{
		return "respawn_anchor";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(50.0, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel(), 6000.0)
		) extends Opaque{
			private int $charges = 0;

			public function readStateFromData(int $id, int $stateMeta) : void{
				if($stateMeta <= 4){
					$this->setCharges($stateMeta);
				}
			}

			protected function writeStateToMeta() : int{
				return $this->getCharges();
			}

			public function getStateBitmask() : int{
				return 0b111;
			}

			public function getCharges() : int{
				return $this->charges;
			}

			public function setCharges(int $charges) : void{
				if($charges > 4 || $charges < 0){
					throw new \InvalidArgumentException("Value must be between 0 and 4");
				}
				$this->charges = $charges;
			}

			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($item->equals(VanillaBlocks::GLOWSTONE()->asItem())){
					if($this->charges >= 4){
						// TODO: explode
						return false;
					}
					$item->pop();
					$this->charges++;
					$this->position->world->setBlock($this->position, $this);
					$this->position->world->addSound($this->position, new RespawnAnchorChargeSound());
					return true;
				}

				return parent::onInteract($item, $face, $clickVector, $player);
			}
		};
	}
}
