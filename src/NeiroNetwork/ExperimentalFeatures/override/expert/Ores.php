<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Ores extends BlockOverrideExpert{

	/**
	 * 金鉱石を破壊したときのドロップを金の原石に変更
	 */
	protected function gold_ore() : Block{
		$b = VanillaBlocks::GOLD_ORE();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Opaque{
			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalItems::RAW_GOLD()];
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
				return [ExperimentalItems::RAW_IRON()];
			}

			public function isAffectedBySilkTouch() : bool{
				return true;
			}
		};
	}

	/**
	 * レッドストーン鉱石を光らないように変更
	 */
	protected function redstone_ore() : Block{
		$b = VanillaBlocks::REDSTONE_ORE();
		return new class($b->getIdInfo(), $b->getName(), $b->getBreakInfo()) extends Opaque{
			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				return false;
			}

			public function onNearbyBlockChange() : void{
			}

			public function ticksRandomly() : bool{
				return false;
			}
		};
	}
}