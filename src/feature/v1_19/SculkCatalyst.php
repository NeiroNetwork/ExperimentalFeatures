<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;

class SculkCatalyst extends Feature implements IBlock{

	public function stringId() : string{
		return "sculk_catalyst";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(3.0, BlockToolType::HOE)
		) extends Opaque{
			private bool $bloom = false;

			public function readStateFromData(int $id, int $stateMeta) : void{
				$this->bloom = ($stateMeta & 0x01) !== 0;
			}

			protected function writeStateToMeta() : int{
				return $this->bloom ? 0x01 : 0;
			}

			public function getStateBitmask() : int{
				return 0b1;
			}

			public function getBloom() : bool{
				return $this->bloom;
			}

			public function setBloom(bool $bloom) : void{
				$this->bloom = $bloom;
			}

			public function getDropsForCompatibleTool(Item $item) : array{
				return [];
			}

			protected function getXpDropAmount() : int{
				return 20;
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}

			public function getLightLevel() : int{
				return 6;
			}
		};
	}
}
