<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\block\VanillaBlocks;

class AnotherBlocks extends BlockOverrideExpert{

	protected function getOverrides() : array{
		return [
			$this->nether_wart_block(),
		];
	}

	/**
	 * ネザーウォートブロックに適性ツールを追加
	 */
	private function nether_wart_block() : Block{
		$b = VanillaBlocks::NETHER_WART_BLOCK();
		return new Opaque($b->getIdInfo(), $b->getName(), new BlockBreakInfo(3.0, BlockToolType::HOE));
	}
}