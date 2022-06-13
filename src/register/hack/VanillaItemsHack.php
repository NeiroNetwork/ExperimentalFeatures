<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class VanillaItemsHack{

	private \ReflectionMethod $register;

	public function __construct(){
		$this->register = (new \ReflectionClass(VanillaItems::class))->getMethod("register");
		$this->register->setAccessible(true);
	}

	public function register(string $name, Item $item) : void{
		$this->register->invokeArgs(null, [$name, $item]);
	}
}
