<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\block;

use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class StoneButton extends \pocketmine\block\StoneButton{

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		return true;
	}
}