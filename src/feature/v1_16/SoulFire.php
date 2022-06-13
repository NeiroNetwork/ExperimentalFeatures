<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Fire;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class SoulFire extends Feature implements IBlock{

	public function stringId() : string{
		return "soul_fire";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Fire{
			public function getLightLevel() : int{
				return 10;
			}

			public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				if($blockReplace->getSide(Facing::DOWN)->isFullCube()){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}
				return false;
			}
		};
	}
}
