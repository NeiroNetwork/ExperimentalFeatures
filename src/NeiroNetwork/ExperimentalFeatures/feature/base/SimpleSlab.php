<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\base;

use pocketmine\block\Block;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

abstract class SimpleSlab extends Transparent{

	protected bool $top = false;

	protected function writeStateToMeta() : int{
		return (int) $this->top;
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->top = (bool) $stateMeta;
	}

	public function canBePlacedAt(Block $blockReplace, Vector3 $clickVector, int $face, bool $isClickedBlock) : bool{
		if(parent::canBePlacedAt($blockReplace, $clickVector, $face, $isClickedBlock)){
			return true;
		}

		if($blockReplace instanceof SimpleSlab and $blockReplace->isSameType($this)){
			if($blockReplace->top){ //Trying to combine with top slab
				return $clickVector->y <= 0.5 or (!$isClickedBlock and $face === Facing::UP);
			}else{
				return $clickVector->y >= 0.5 or (!$isClickedBlock and $face === Facing::DOWN);
			}
		}

		return false;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($blockReplace instanceof SimpleSlab and $blockReplace->isSameType($this) and (
				($blockReplace->top and ($clickVector->y <= 0.5 or $face === Facing::UP)) or
				(!$blockReplace->top and ($clickVector->y >= 0.5 or $face === Facing::DOWN))
			)){
			//Clicked in empty half of existing slab
			$player?->sendMessage("double slab!");
			// TODO: place double slab
			// $tx->addBlock($blockReplace->position, $this);
			// return true;
		}

		$this->top = (($face !== Facing::UP && $clickVector->y > 0.5) || $face === Facing::DOWN);
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}