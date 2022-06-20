<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_19;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;

class MangroveRoots extends Feature implements IBlock{

	public function stringId() : string{
		return "mangrove_roots";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			new BlockBreakInfo(0.7)
		) extends Transparent{
			public function getFlameEncouragement() : int{
				// TODO: Research the value
				return parent::getFlameEncouragement();
			}

			public function getFlammability() : int{
				// TODO: Research the value
				return parent::getFlammability();
			}

			public function getFuelTime() : int{
				return 300;
			}
		};
	}
}