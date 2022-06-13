<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\interfaces;

use pocketmine\item\Item;

interface IItem{

	public function item() : Item;
}
