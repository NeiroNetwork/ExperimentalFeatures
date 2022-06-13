<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;

class BarrierBlock extends BlockOverrideExpert{

	protected function barrier() : Block{
		$b = VanillaBlocks::BARRIER();
		return new class(
			$b->getIdInfo(),
			$b->getName(),
			BlockBreakInfo::indestructible(18000004.0)
		) extends Opaque{
			public function getLightFilter() : int{
				return 0;
			}
		};
	}
}
