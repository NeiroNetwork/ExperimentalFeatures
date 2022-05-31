<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\network\mcpe\convert\GlobalItemTypeDictionary;

/**
 * 新しく実装するアイテムあるいはブロックを実装するためのクラス
 */
abstract class Feature{

	private bool $registeredPmmp;
	private int $internalBlockId;
	private int $internalItemId;

	public function __construct(){
		$this->registeredPmmp = LegacyBlockIdToStringIdMap::getInstance()->stringToLegacy($this->fullStringId()) !== null
			|| LegacyItemIdToStringIdMap::getInstance()->stringToLegacy($this->fullStringId()) !== null;
		if($this->isRegisteredPmmp()){
			$this->internalBlockId = LegacyBlockIdToStringIdMap::getInstance()->stringToLegacy($this->fullStringId()) ?? BlockLegacyIds::INFO_UPDATE;
			$this->internalItemId = LegacyItemIdToStringIdMap::getInstance()->stringToLegacy($this->fullStringId()) ?? ItemIds::INFO_UPDATE;
		}else{
			$this->internalBlockId = $this->internalItemId = InternalIdCounter::next();
		}
	}

	abstract public function stringId() : string;

	public function fullStringId() : string{
		return "minecraft:" . $this->stringId();
	}

	public function displayName() : string{
		return ucwords(str_replace("_", " ", $this->stringId()));
	}

	public function blockId() : BlockIdentifier{
		return new BlockIdentifier($this->internalBlockId, 0, $this->internalItemId);
	}

	public function itemId() : ItemIdentifier{
		return new ItemIdentifier($this->internalItemId, 0);
	}

	public function runtimeId() : int{
		return GlobalItemTypeDictionary::getInstance()->getDictionary()->fromStringId($this->fullStringId());
	}

	public function isRegisteredPmmp() : bool{
		return $this->registeredPmmp;
	}

	public function afterRegistration() : void{
	}
}