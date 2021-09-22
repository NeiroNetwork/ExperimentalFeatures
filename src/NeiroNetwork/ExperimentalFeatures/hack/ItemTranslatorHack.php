<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\network\mcpe\convert\ItemTranslator;

class ItemTranslatorHack{

	private static \ReflectionProperty $coreToNet;
	private static \ReflectionProperty $netToCore;

	public static function prepare() : void{
		$translator = ItemTranslator::getInstance();
		$reflection = new \ReflectionClass($translator);
		self::$coreToNet = $reflection->getProperty("simpleCoreToNetMapping");
		self::$coreToNet->setAccessible(true);
		self::$netToCore = $reflection->getProperty("simpleNetToCoreMapping");
		self::$netToCore->setAccessible(true);
	}

	public static function hack(int $internal, int $network) : void{
		$translator = ItemTranslator::getInstance();
		$value = self::$coreToNet->getValue($translator);
		$value[$internal] = $network;
		self::$coreToNet->setValue($translator, $value);
		$value = self::$netToCore->getValue($translator);
		$value[$network] = $internal;
		self::$netToCore->setValue($translator, $value);
	}
}