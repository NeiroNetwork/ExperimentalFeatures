<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\Lantern;

/**
 * ランタンを設置しやすくする (完璧ではない)
 */
class LanternBlock{

	public function __construct(){
		foreach(BlockFactory::getInstance()->getAllKnownStates() as $block){
			if($block instanceof Lantern){
				$newLantern = new class($block->getIdInfo(), $block->getName(), $block->getBreakInfo()) extends Lantern{
					protected function canAttachTo(Block $b) : bool{
						return $b->isSolid();
					}
				};
				BlockFactory::getInstance()->register($newLantern, true);
			}
		}
	}
}