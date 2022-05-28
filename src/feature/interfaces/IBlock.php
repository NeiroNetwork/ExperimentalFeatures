<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\interfaces;

use pocketmine\block\Block;

interface IBlock{

	public function block() : Block;
}