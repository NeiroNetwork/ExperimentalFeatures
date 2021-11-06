<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\item;

use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\FlintSteel;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\FlintSteelSound;

class ItemFlintSteel extends ItemOverrideExpert{

	protected function flint_and_steel() : Item{
		$i = VanillaItems::FLINT_AND_STEEL();
		return new class($this->toIdentifier($i), $i->getName()) extends FlintSteel{
			public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
				// 着火できるブロックを制限する
				$down = $blockReplace->getSide(Facing::DOWN);
				if(!$blockClicked->isFlammable() && !($blockClicked->isFullCube() && !$blockClicked->isTransparent())
					&& !$down->isFlammable() && !($down->isFullCube() && !$down->isTransparent())){
					return ItemUseResult::NONE();
				}

				// ソウルサンド|ソウルソイル に着火した場合は魂の炎を設置する
				if($down->getId() === BlockLegacyIds::SOUL_SAND || $down->getName() === "Soul Soil"){
					$world = $player->getWorld();
					$world->setBlock($blockReplace->getPosition(), ExperimentalBlocks::fromString("soul_fire"));
					$world->addSound($blockReplace->getPosition()->add(0.5, 0.5, 0.5), new FlintSteelSound());

					$this->applyDamage(1);

					return ItemUseResult::SUCCESS();
				}

				return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector);
			}
		};
	}
}