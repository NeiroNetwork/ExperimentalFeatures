<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\Flowable;
use pocketmine\block\Lantern;
use pocketmine\block\VanillaBlocks;

/**
 * ランタンを設置しやすくする (完璧ではない)
 */
class LanternBlock{

	public function __construct(){
		$lantern = VanillaBlocks::LANTERN();
		$lantern = new class($lantern->getIdInfo(), $lantern->getName(), $lantern->getBreakInfo()) extends Lantern{
			protected function canAttachTo(Block $b) : bool{
				return !empty($b->recalculateCollisionBoxes()) && !($b instanceof Flowable);
			}
		};
		BlockFactory::getInstance()->register($lantern, true);
	}
}