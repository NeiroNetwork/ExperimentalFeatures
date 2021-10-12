<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_17;

use NeiroNetwork\ExperimentalFeatures\feature\base\BaseAmethystCluster;
use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\Block;
use pocketmine\item\Item;

class AmethystCluster extends Feature implements IBlock{

	public function networkId() : int{
		return -329;
	}

	public function name() : string{
		return "amethyst_cluster";
	}

	public function block() : Block{
		return new class($this->blockId(), "Amethyst Cluster") extends BaseAmethystCluster{
			// TODO: recalculateCollisionBoxes()

			public function getDropsForCompatibleTool(Item $item) : array{
				return [ExperimentalItems::AMETHYST_SHARD()->setCount(4)];
			}

			public function getDropsForIncompatibleTool(Item $item) : array{
				return [ExperimentalItems::AMETHYST_SHARD()->setCount(2)];
			}
		};
	}
}