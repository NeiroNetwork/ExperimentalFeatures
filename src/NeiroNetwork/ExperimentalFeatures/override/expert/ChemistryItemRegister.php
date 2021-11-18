<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class ChemistryItemRegister implements Expert{

	public function doOverride() : void{
		$addItem = function(int $id, int $meta = 0) : void{
			CreativeInventory::getInstance()->add(ItemFactory::getInstance()->get($id, $meta));
		};

		// 強化ガラス
		$addItem(ItemIds::HARD_GLASS);
		for($i = 0; $i < 16; $i++) $addItem(ItemIds::HARD_STAINED_GLASS, $i);
		$addItem(ItemIds::HARD_GLASS_PANE);
		for($i = 0; $i < 16; $i++) $addItem(ItemIds::HARD_STAINED_GLASS_PANE, $i);

		// 色付きの松明
		$addItem(ItemIds::COLORED_TORCH_BP, 0);
		$addItem(ItemIds::COLORED_TORCH_BP, 8);
		$addItem(ItemIds::COLORED_TORCH_RG, 0);
		$addItem(ItemIds::COLORED_TORCH_RG, 8);
	}
}