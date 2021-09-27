<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\block\Block;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class BlockMappingHack{

	// RuntimeBlockMapping
	private ReflectionMethod $registerMapping;
	private array $idToStatesMap = [];

	// LegacyBlockIdToStringIdMap
	private ReflectionProperty $legacyToString;
	private ReflectionProperty $stringToLegacy;

	public function __construct(){
		$map = RuntimeBlockMapping::getInstance();
		$this->registerMapping = (new ReflectionClass($map))->getMethod("registerMapping");
		$this->registerMapping->setAccessible(true);

		foreach($map->getBedrockKnownStates() as $k => $state){
			$this->idToStatesMap[$state->getString("name")][] = $k;
		}

		$parent = (new ReflectionClass(LegacyBlockIdToStringIdMap::getInstance()))->getParentClass();
		$this->legacyToString = $parent->getProperty("legacyToString");
		$this->legacyToString->setAccessible(true);
		$this->stringToLegacy = $parent->getProperty("stringToLegacy");
		$this->stringToLegacy->setAccessible(true);
	}

	public function hack(string $name, Block $block) : void{
		$map = RuntimeBlockMapping::getInstance();
		foreach($this->idToStatesMap[$name] as $key => $staticRuntimeId){
			$this->registerMapping->invoke($map, $staticRuntimeId, $block->getId(), $key);
		}

		$map = LegacyBlockIdToStringIdMap::getInstance();
		$value = $this->legacyToString->getValue($map);
		$value[$block->getId()] = $name;
		$this->legacyToString->setValue($map, $value);
		$value = $this->stringToLegacy->getValue($map);
		$value[$name] = $block->getId();
		$this->stringToLegacy->setValue($map, $value);
	}
}