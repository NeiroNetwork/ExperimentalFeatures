<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_16;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use pocketmine\item\Item;

class NetheriteIngot extends Feature implements IItem{

	function stringId() : string{
		return "netherite_ingot";
	}

	public function item() : Item{
		// TODO: アイテムが燃えないようにする(?)
		return new Item($this->itemId(), $this->displayName());
	}
}