<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use pocketmine\block\Block;
use pocketmine\block\SoulSand;
use pocketmine\block\VanillaBlocks;
use pocketmine\math\AxisAlignedBB;

class BlockSoulSand extends BlockOverrideExpert{

	/**
	 * 当たり判定をフルブロックへ変更
	 * ソウルサンドに点いた火は燃え続けるように
	 */
	protected function soul_sand() : Block{
		$b = VanillaBlocks::SOUL_SAND();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends SoulSand{
			protected function recalculateCollisionBoxes() : array{
				return [AxisAlignedBB::one()];
			}

			public function burnsForever() : bool{
				return true;
			}
		};
	}
}