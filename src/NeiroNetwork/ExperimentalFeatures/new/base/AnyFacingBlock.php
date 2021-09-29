<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\base;

use pocketmine\block\Block;
use pocketmine\block\utils\AnyFacingTrait;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

abstract class AnyFacingBlock extends Block{
	use AnyFacingTrait;

	protected function writeStateToMeta() : int{
		return BlockDataSerializer::writeFacing($this->facing);
	}

	public function readStateFromData(int $id, int $stateMeta) : void{
		$this->facing = BlockDataSerializer::readFacing($stateMeta);
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		$this->facing = $face;
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}