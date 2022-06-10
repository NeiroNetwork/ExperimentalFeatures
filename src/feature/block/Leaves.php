<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class Leaves extends Transparent{

	public function __construct(BlockIdentifier $idInfo, string $name, private Item $sapling){
		parent::__construct($idInfo, $name, new BlockBreakInfo(0.2, BlockToolType::HOE));
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		if(($item->getBlockToolType() & BlockToolType::SHEARS) !== 0){
			return parent::getDropsForCompatibleTool($item);
		}

		$drops = [];
		if(mt_rand(1, 20) === 1) $drops[] = clone $this->sapling;
		if(mt_rand(1, 50) === 1) $drops[] = VanillaItems::STICK()->setCount(mt_rand(1, 2));
		return $drops;
	}

	public function blocksDirectSkyLight() : bool{
		return true;
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}

	public function getFlameEncouragement() : int{
		return 30;
	}

	public function getFlammability() : int{
		return 60;
	}
}