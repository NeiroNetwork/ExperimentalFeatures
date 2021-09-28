<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override;

use pocketmine\block\BaseSign;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\tile\TileFactory;

class Signs{

	public function __construct(){
		TileFactory::getInstance()->register(SignTile::class, ["Sign", "minecraft:sign"]);

		foreach(BlockFactory::getInstance()->getAllKnownStates() as $block){
			if($block instanceof BaseSign){
				$info = $block->getIdInfo();
				$newInfo = new BlockIdentifier($info->getBlockId(), $info->getVariant(), $info->getItemId(), SignTile::class);

				$property = (new \ReflectionClass($block))->getProperty("idInfo");
				$property->setAccessible(true);
				$property->setValue($block, $newInfo);

				BlockFactory::getInstance()->register($block, true);
			}
		}
	}
}