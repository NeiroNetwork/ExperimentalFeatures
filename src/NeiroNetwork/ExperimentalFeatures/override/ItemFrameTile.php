<?php /** @noinspection PhpDeprecationInspection */

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\tile\ItemFrame;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\Binary;

class ItemFrameTile extends ItemFrame{

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		$nbt->setFloat(self::TAG_ITEM_DROP_CHANCE, $this->getItemDropChance());
		$nbt->setByte(self::TAG_ITEM_ROTATION, $this->getItemRotation());
		$nbt->setTag(self::TAG_ITEM, $this->itemNbtSerialize($this->getItem()));
	}

	private function itemNbtSerialize(Item $item) : CompoundTag{
		$result = CompoundTag::create()
			->setString("Name", LegacyItemIdToStringIdMap::getInstance()->legacyToString($item->getId()) ?? "minecraft:info_update")
			->setByte("Count", Binary::signByte($item->getCount()))
			->setShort("Damage", $item->getMeta());

		if($item->hasNamedTag()){
			$result->setTag("tag", $item->getNamedTag());
		}

		return $result;
	}
}