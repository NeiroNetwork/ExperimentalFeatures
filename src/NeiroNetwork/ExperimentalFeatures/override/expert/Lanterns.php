<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\Lantern;
use pocketmine\block\VanillaBlocks;

class Lanterns extends BlockOverrideExpert{

	protected function getOverrides() : array{
		return [
			$this->lantern(),
			$this->soul_lantern(),
		];
	}

	/**
	 * ランタンを設置しやすくする
	 */
	private function lantern() : Block{
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
	private function soul_lantern() : Block{
		$b = ExperimentalBlocks::SOUL_LANTERN();
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