<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use pocketmine\block\Block;
use pocketmine\block\utils\SignLikeRotationTrait;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

/**
 * @see \pocketmine\block\FloorSign
 */
class FloorSign extends BaseSign{
	use SignLikeRotationTrait;

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->rotation = $stateMeta;
	}

	protected function writeStateToMeta() : int{
		return $this->rotation;
	}

	public function getStateBitmask() : int{
		return 0b1111;
	}

	protected function getSupportingFace() : int{
		return Facing::DOWN;
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($face !== Facing::UP){
			return false;
		}

		if($player !== null){
			$this->rotation = self::getRotationFromYaw($player->getLocation()->getYaw());
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}