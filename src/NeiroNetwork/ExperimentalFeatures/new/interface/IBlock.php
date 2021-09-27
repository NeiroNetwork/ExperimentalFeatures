<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\block\Block;

interface IBlock{

	public function internalId() : int;
	public function name() : string;

	public function block() : Block;
}