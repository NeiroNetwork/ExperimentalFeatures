<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\v1_16\block\Vines;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\math\Facing;

class WeepingVines extends Feature implements IBlock{

	public function stringId() : string{
		return "weeping_vines";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Vines{
			protected function hasSupportBlock() : bool{
				$up = $this->getSide(Facing::UP);
				return $up->isSameType($this) || $up->getSupportType(Facing::DOWN)->hasCenterSupport();
			}
		};
	}
}
