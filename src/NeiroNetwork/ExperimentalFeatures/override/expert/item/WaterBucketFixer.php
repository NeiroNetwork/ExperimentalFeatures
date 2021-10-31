<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\item;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\item\LiquidBucket;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\network\mcpe\protocol\types\BlockPosition;
use pocketmine\network\mcpe\protocol\UpdateBlockPacket;
use pocketmine\player\Player;

class WaterBucketFixer extends ItemOverrideExpert{

	public static function removeWaterFrom(Player $player, Vector3 $pos) : void{
		/** @noinspection PhpInternalEntityUsedInspection */
		$pk = UpdateBlockPacket::create(BlockPosition::fromVector3($pos),
			RuntimeBlockMapping::getInstance()->toRuntimeId(VanillaBlocks::AIR()->getFullId()),
			UpdateBlockPacket::FLAG_NETWORK,
			UpdateBlockPacket::DATA_LAYER_LIQUID);
		$player->getNetworkSession()->sendDataPacket($pk);
	}

	protected function water_bucket() : Item{
		$i = VanillaItems::WATER_BUCKET();
		return new class($this->toIdentifier($i), $i->getName(), $i->getLiquid()) extends LiquidBucket{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				WaterBucketFixer::removeWaterFrom($player, $blockReplace->getPosition());
				WaterBucketFixer::removeWaterFrom($player, $blockClicked->getPosition());
				return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector);
			}
		};
	}
}