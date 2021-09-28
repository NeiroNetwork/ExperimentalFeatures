<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\base;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;

abstract class BaseAmethystCluster extends AnyFacingBlock{

	public function __construct(BlockIdentifier $idInfo, string $name){
		parent::__construct($idInfo, $name, new BlockBreakInfo(1.5, BlockToolType::PICKAXE));
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}
}