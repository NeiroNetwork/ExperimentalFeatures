<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

abstract class BlockOverrideExpert implements Expert{

	public function doOverride() : void{
		array_map(fn(Block $block) => BlockFactory::getInstance()->register($block, true), $this->getOverrides());
	}

	/**
	 * @return Block[]
	 */
	abstract protected function getOverrides() : array;
}