<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;

class LegacyBlockIdToStringIdMapHack{

	private \ReflectionProperty $legacyToString;
	private \ReflectionProperty $stringToLegacy;

	public function __construct(){
		$parent = (new \ReflectionClass(LegacyBlockIdToStringIdMap::getInstance()))->getParentClass();
		$this->legacyToString = $parent->getProperty("legacyToString");
		$this->legacyToString->setAccessible(true);
		$this->stringToLegacy = $parent->getProperty("stringToLegacy");
		$this->stringToLegacy->setAccessible(true);
	}

	public function hack(string $fullStringId, int $blockId) : void{
		$mapping = LegacyBlockIdToStringIdMap::getInstance();

		$legacyToString = $this->legacyToString->getValue($mapping);
		$legacyToString[$blockId] = $fullStringId;
		$this->legacyToString->setValue($mapping, $legacyToString);

		$stringToLegacy = $this->stringToLegacy->getValue($mapping);
		$stringToLegacy[$fullStringId] = $blockId;
		$this->stringToLegacy->setValue($mapping, $stringToLegacy);
	}
}
