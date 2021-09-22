<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class VanillaItemsHack{

	private static \ReflectionMethod $register;

	public static function prepare() : void{
		$registry = new \ReflectionClass(VanillaItems::class);
		self::$register = $registry->getMethod("register");
		self::$register->setAccessible(true);
	}

	public static function hack(string $name, Item $item) : void{
		self::$register->invoke(null, $name, $item);
	}
}