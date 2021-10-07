<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;

class NetherWartBlock{

	public function __construct(){
		BlockFactory::getInstance()->register(new Opaque(
			new BlockIdentifier(BlockLegacyIds::NETHER_WART_BLOCK, 0),
			"Nether Wart Block",
			new BlockBreakInfo(3.0, BlockToolType::HOE)
		), true);
	}
}