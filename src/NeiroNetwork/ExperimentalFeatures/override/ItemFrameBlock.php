<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\ItemFrame;
use pocketmine\block\tile\TileFactory;
use pocketmine\item\ItemIds;

class ItemFrameBlock{

	public function __construct(){
		TileFactory::getInstance()->register(ItemFrameTile::class, ["ItemFrame"]);
		BlockFactory::getInstance()->register(new ItemFrame(
			new BlockIdentifier(
				BlockLegacyIds::FRAME_BLOCK,
				0,
				ItemIds::FRAME,
				ItemFrameTile::class
			), "Item Frame", new BlockBreakInfo(0.25)
		), true);
	}
}