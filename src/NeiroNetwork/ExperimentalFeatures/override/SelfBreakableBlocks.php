<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\StoneButton;
use pocketmine\block\StonePressurePlate;
use pocketmine\block\WoodenButton;
use pocketmine\block\WoodenPressurePlate;
use pocketmine\math\Facing;

/**
 * 木のボタン
 * 石のボタン
 * 木の感圧版
 * 石の感圧版
 */
class SelfBreakableBlocks{

	public function __construct(){
		foreach(BlockFactory::getInstance()->getAllKnownStates() as $block){
			$new = match(true){
				$block instanceof WoodenButton => $this->woodenButton($block),
				$block instanceof StoneButton => $this->stoneButton($block),
				$block instanceof WoodenPressurePlate => $this->woodenPressurePlate($block),
				$block instanceof StonePressurePlate => $this->stonePressurePlate($block),
				default => null,
			};
			if($new !== null){
				BlockFactory::getInstance()->register($new, true);
			}
		}
	}

	private function woodenButton(WoodenButton $block) : WoodenButton{
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends WoodenButton{
			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::opposite($this->facing))->getId() === BlockLegacyIds::AIR){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}

	private function stoneButton(StoneButton $block) : StoneButton{
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends StoneButton{
			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::opposite($this->facing))->getId() === BlockLegacyIds::AIR){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}

	private function woodenPressurePlate(WoodenPressurePlate $block) : WoodenPressurePlate{
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends WoodenPressurePlate{
			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::DOWN)->isFullCube()){ //FIXME: 不完全
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}

	private function stonePressurePlate(StonePressurePlate $block) : StonePressurePlate{
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends StonePressurePlate{
			public function onNearbyBlockChange() : void{
				if($this->getSide(Facing::DOWN)->isFullCube()){ //FIXME: 不完全
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
		};
	}
}