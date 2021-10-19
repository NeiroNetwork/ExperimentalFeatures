<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\BlockFactory;
use pocketmine\block\Redstone;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class RedstoneOre{

	public function __construct(){
		$block = VanillaBlocks::REDSTONE_ORE();
		$newBlock = new class(
			$block->getIdInfo(),
			$block->getName(),
			$block->getBreakInfo()
		) extends Redstone{
			public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
				return false;
			}
			public function onNearbyBlockChange() : void{
			}
			public function ticksRandomly() : bool{
				return false;
			}
		};

		BlockFactory::getInstance()->register($newBlock, true);
	}
}