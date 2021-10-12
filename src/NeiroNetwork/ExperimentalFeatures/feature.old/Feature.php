<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use pocketmine\block\BlockIdentifier;
use pocketmine\item\ItemIdentifier;

abstract class OldFeature{

	private int $internalId;

	public function __construct(){
		$this->internalId = InternalIdCounter::next();
	}

	final public function internalId() : int{
		return $this->internalId;
	}

	protected function blockId() : BlockIdentifier{
		return new BlockIdentifier($this->internalId(), 0, $this->internalId());
	}

	protected function itemId() : ItemIdentifier{
		return new ItemIdentifier($this->internalId(), 0);
	}
}