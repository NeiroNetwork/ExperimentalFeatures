<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\base;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\item\ToolTier;
use pocketmine\math\Facing;

abstract class BaseAmethystCluster extends AnyFacingBlock{

	public function __construct(BlockIdentifier $idInfo, string $name){
		parent::__construct($idInfo, $name, new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()));
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}

	public function onNearbyBlockChange() : void{
		if(!$this->getSide(Facing::opposite($this->facing))->isSolid()){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}
}