<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;

class BuddingAmethyst extends Feature implements IBlock{

	public function networkId() : int{
		return -328;
	}

	public function name() : string{
		return "budding_amethyst";
	}

	public function block() : Block{
		// FIXME: 採掘にかかる時間がwikiと合致しない
		return new class(
			new BlockIdentifier($this->internalId(), 0, $this->internalId()),
			"Budding Amethyst",
			new BlockBreakInfo(1.5, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())
		) extends Opaque{
			public function getDrops(Item $item) : array{
				return [];
			}
		};
	}
}