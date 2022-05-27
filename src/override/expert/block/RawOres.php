<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\block;

use pocketmine\block\Block;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RawOres extends BlockOverrideExpert{

	/**
	 * 金鉱石を破壊したときのドロップを金の原石に変更
	 */
	protected function gold_ore() : Block{
		$b = VanillaBlocks::GOLD_ORE();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::raw_gold()];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}

	/**
	 * 鉄鉱石を破壊したときのドロップを鉄の原石に変更
	 */
	protected function iron_ore() : Block{
		$b = VanillaBlocks::IRON_ORE();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [VanillaItems::raw_iron()];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}
}