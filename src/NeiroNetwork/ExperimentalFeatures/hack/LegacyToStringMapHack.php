<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;

class LegacyToStringMapHack{

	private static \ReflectionProperty $legacyToString;
	private static \ReflectionProperty $stringToLegacy;

	public static function prepare() : void{
		$parent = (new \ReflectionClass(LegacyBlockIdToStringIdMap::getInstance()))->getParentClass();
		self::$legacyToString = $parent->getProperty("legacyToString");
		self::$legacyToString->setAccessible(true);
		self::$stringToLegacy = $parent->getProperty("stringToLegacy");
		self::$stringToLegacy->setAccessible(true);
	}

	public static function hack(int $legacy, string $string) : void{
		$map = LegacyBlockIdToStringIdMap::getInstance();
		$value = self::$legacyToString->getValue($map);
		$value[$legacy] = $string;
		self::$legacyToString->setValue($map, $value);
		$value = self::$stringToLegacy->getValue($map);
		$value[$string] = $legacy;
		self::$stringToLegacy->setValue($map, $value);
	}
}