<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\StoneButton;
use pocketmine\block\StonePressurePlate;
use pocketmine\block\WoodenButton;
use pocketmine\block\WoodenPressurePlate;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class ButtonsAndPressurePlates{

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
				if(!$this->getSide(Facing::opposite($this->facing))->isFullCube()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if(!$this->getSide(Facing::opposite($face))->isFullCube()){
					return false;
				}
				return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
			}
		};
	}

	private function stoneButton(StoneButton $block) : StoneButton{
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends StoneButton{
			public function onNearbyBlockChange() : void{
				if(!$this->getSide(Facing::opposite($this->facing))->isFullCube()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if(!$this->getSide(Facing::opposite($face))->isFullCube()){
					return false;
				}
				return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
			}
		};
	}

	private function woodenPressurePlate(WoodenPressurePlate $block) : WoodenPressurePlate{
		// FIXME: Block::isFullCube() は不完全な検証(不完全ではあるが安全)
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends WoodenPressurePlate{
			public function onNearbyBlockChange() : void{
				if(!$this->getSide(Facing::DOWN)->isFullCube()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if(!$this->getSide(Facing::DOWN)->isFullCube()){
					return false;
				}
				return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
			}
		};
	}

	private function stonePressurePlate(StonePressurePlate $block) : StonePressurePlate{
		// FIXME: Block::isFullCube() は不完全な検証(不完全ではあるが安全)
		return new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends StonePressurePlate{
			public function onNearbyBlockChange() : void{
				if(!$this->getSide(Facing::DOWN)->isFullCube()){
					$this->position->getWorld()->useBreakOn($this->position);
				}
			}
			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if(!$this->getSide(Facing::DOWN)->isFullCube()){
					return false;
				}
				return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
			}
		};
	}
}