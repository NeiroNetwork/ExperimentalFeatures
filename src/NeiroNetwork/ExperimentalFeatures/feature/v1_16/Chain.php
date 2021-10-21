<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\block\SimplePillarTrait;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\Transparent;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;

class Chain extends Feature implements IBlock{

	function stringId() : string{
		return "chain";
	}

	public function block() : Block{
		return new class(
			$this->blockId(),
			$this->displayName(),
			BlockBreakInfo::instant()
		) extends Transparent{
			use SimplePillarTrait;
			protected function recalculateCollisionBoxes() : array{
				$inset = 7 / 16;
				$bb = match($this->axis){
					Axis::X => AxisAlignedBB::one()->contract(0, $inset, $inset),
					Axis::Y => AxisAlignedBB::one()->contract($inset, 0, $inset),
					Axis::Z => AxisAlignedBB::one()->contract($inset, $inset, 0),
				};
				return [$bb];
			}
		};
	}
}