<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new\interface;

use pocketmine\item\Item;

interface IItem{

	public function networkId() : int;

	public function name() : string;
	public function item() : Item;
}