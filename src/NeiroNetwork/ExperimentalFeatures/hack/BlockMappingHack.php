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
	private static ReflectionMethod $registerMapping;
	private static array $idToStatesMap = [];

	// LegacyBlockIdToStringIdMap
	private static ReflectionProperty $legacyToString;
	private static ReflectionProperty $stringToLegacy;

	public static function prepare() : void{
		$map = RuntimeBlockMapping::getInstance();
		self::$registerMapping = (new ReflectionClass($map))->getMethod("registerMapping");
		self::$registerMapping->setAccessible(true);

		foreach($map->getBedrockKnownStates() as $k => $state){
			self::$idToStatesMap[$state->getString("name")][] = $k;
		}

		$parent = (new ReflectionClass(LegacyBlockIdToStringIdMap::getInstance()))->getParentClass();
		self::$legacyToString = $parent->getProperty("legacyToString");
		self::$legacyToString->setAccessible(true);
		self::$stringToLegacy = $parent->getProperty("stringToLegacy");
		self::$stringToLegacy->setAccessible(true);
	}

	public static function hack(string $name, Block $block) : void{
		$map = RuntimeBlockMapping::getInstance();
		foreach(self::$idToStatesMap[$name] as $key => $staticRuntimeId){
			self::$registerMapping->invoke($map, $staticRuntimeId, $block->getId(), $key);
		}

		$map = LegacyBlockIdToStringIdMap::getInstance();
		$value = self::$legacyToString->getValue($map);
		$value[$block->getId()] = $name;
		self::$legacyToString->setValue($map, $value);
		$value = self::$stringToLegacy->getValue($map);
		$value[$name] = $block->getId();
		self::$stringToLegacy->setValue($map, $value);
	}
}