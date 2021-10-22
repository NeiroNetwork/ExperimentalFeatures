<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\item\LiquidBucket;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\network\mcpe\protocol\UpdateBlockPacket;
use pocketmine\player\Player;

class WaterBucketFixer extends ItemOverrideExpert{

	protected function water_bucket() : Item{
		$i = VanillaItems::WATER_BUCKET();
		return new class($this->toIdentifier($i), $i->getName(), $i->getLiquid()) extends LiquidBucket{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				$removeWater = function(Vector3 $pos) use ($player) : void{
					/** @noinspection PhpInternalEntityUsedInspection */
					$runtimeId = RuntimeBlockMapping::getInstance()->toRuntimeId(VanillaBlocks::AIR()->getFullId());
					$pk = UpdateBlockPacket::create($pos->x, $pos->y, $pos->z, $runtimeId);
					$pk->dataLayerId = UpdateBlockPacket::DATA_LAYER_LIQUID;
					$player->getNetworkSession()->sendDataPacket($pk);
				};
				$removeWater($blockReplace->getPosition());
				$removeWater($blockClicked->getPosition());
				return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector);
			}
		};
	}
}