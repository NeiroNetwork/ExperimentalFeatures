<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert;

use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\inventory\CreativeInventory;

class ChemistryItemRegister implements Expert{

	public function doOverride() : void{
		$factory = BlockFactory::getInstance();
		$inventory = CreativeInventory::getInstance();

		// 強化ガラス
		$inventory->add($factory->get(BlockLegacyIds::HARD_GLASS, 0)->asItem());
		for($i = 0; $i < 16; $i++) $inventory->add($factory->get(BlockLegacyIds::HARD_STAINED_GLASS, $i)->asItem());
		$inventory->add($factory->get(BlockLegacyIds::HARD_GLASS_PANE, 0)->asItem());
		for($i = 0; $i < 16; $i++) $inventory->add($factory->get(BlockLegacyIds::HARD_STAINED_GLASS_PANE, $i)->asItem());
	}
}