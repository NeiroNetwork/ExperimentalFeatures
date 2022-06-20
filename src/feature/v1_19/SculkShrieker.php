<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\utils\SupportType;
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
		) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{ return []; }

			protected function getXpDropAmount() : int{ return 5; }

			public function isAffectedBySilkTouch() : bool{ return true; }

			protected function recalculateCollisionBoxes() : array{
				return [AxisAlignedBB::one()->trim(Facing::UP, 8 / 16)];
			}

			public function getSupportType(int $facing) : SupportType{
				return $facing === Facing::DOWN ? SupportType::FULL() : SupportType::NONE();
			}
		};
	}
}
