<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_14;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\utils\BlockDataSerializer;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\NormalHorizontalFacingInMetadataTrait;

class Beehive extends Feature implements IBlock{

	public function stringId() : string{
		return "beehive";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.6, BlockToolType::AXE)
		) extends Opaque{
			use FacesOppositePlacingPlayerTrait;
			use NormalHorizontalFacingInMetadataTrait;

			// TODO: 今のところ、養蜂箱はメタ値0~15の範囲に蜜が溜まった状態が存在しない

			protected function writeStateToMeta() : int{
				return BlockDataSerializer::writeLegacyHorizontalFacing($this->facing);
			}

			public function readStateFromData(int $id, int $stateMeta) : void{
				$this->facing = BlockDataSerializer::readLegacyHorizontalFacing($stateMeta & 0b011);
			}
		};
	}
}