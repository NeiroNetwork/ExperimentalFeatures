<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;

class LegacyItemIdToStringIdMapHack{

	private \ReflectionProperty $legacyToString;
	private \ReflectionProperty $stringToLegacy;

	public function __construct(){
		$parent = (new \ReflectionClass(LegacyItemIdToStringIdMap::getInstance()))->getParentClass();
		$this->legacyToString = $parent->getProperty("legacyToString");
		$this->legacyToString->setAccessible(true);
		$this->stringToLegacy = $parent->getProperty("stringToLegacy");
		$this->stringToLegacy->setAccessible(true);
	}

	public function hack(string $fullStringId, int $itemId) : void{
		$mapping = LegacyItemIdToStringIdMap::getInstance();

		$legacyToString = $this->legacyToString->getValue($mapping);
		$legacyToString[$itemId] = $fullStringId;
		$this->legacyToString->setValue($mapping, $legacyToString);

		$stringToLegacy = $this->stringToLegacy->getValue($mapping);
		$stringToLegacy[$fullStringId] = $itemId;
		$this->stringToLegacy->setValue($mapping, $stringToLegacy);
	}
}