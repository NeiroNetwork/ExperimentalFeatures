<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class VanillaBlocksHack{

	private \ReflectionMethod $register;

	public function __construct(){
		$this->register = (new \ReflectionClass(VanillaBlocks::class))->getMethod("register");
		$this->register->setAccessible(true);
	}

	public function register(string $name, Block $block) : void{
		$this->register->invokeArgs(null, [$name, $block]);
	}
}