<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use pocketmine\block\BlockIdentifier;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\ItemIdentifier;
use pocketmine\network\mcpe\convert\GlobalItemTypeDictionary;

/**
 * 新しく実装するアイテムあるいはブロックを実装するためのクラス
 */
abstract class Feature{

	private int $internalBlockId;
	private int $internalItemId;

	public function __construct(){
		$this->internalBlockId = LegacyBlockIdToStringIdMap::getInstance()->stringToLegacy($this->stringId()) ?? $id = InternalIdCounter::next();
		$this->internalItemId = LegacyItemIdToStringIdMap::getInstance()->stringToLegacy($this->stringId()) ?? ($id ?? InternalIdCounter::next());
	}

	abstract function stringId() : string;

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
		return GlobalItemTypeDictionary::getInstance()->getDictionary()->fromStringId($this->stringId());
	}
}