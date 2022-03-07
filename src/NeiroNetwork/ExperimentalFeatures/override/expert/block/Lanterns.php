<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use pocketmine\block\Block;
use pocketmine\block\Lantern;
use pocketmine\block\VanillaBlocks;

class Lanterns extends BlockOverrideExpert{

	/**
	 * ランタンを設置しやすくする
	 */
	protected function lantern() : Block{
		$b = VanillaBlocks::LANTERN();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Lantern{
			protected function canAttachTo(Block $b) : bool{
				return $b->isSolid();
			}
		};
	}

	/**
	 * 魂のランタンを設置しやすくする
	 * FIXME: SoulLantern と全く同じ定義を繰り返している
	 */
	protected function soul_lantern() : Block{
		$b = VanillaBlocks::soul_lantern();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Lantern{
			protected function canAttachTo(Block $b) : bool{
				return $b->isSolid();
			}

			public function getLightLevel() : int{
				return 10;
			}
		};
	}
}