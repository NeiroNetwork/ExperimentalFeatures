<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

class Feature{

	private int $internalId;

	public function __construct(){
		$this->internalId = InternalIdCounter::next();
	}

	final public function internalId() : int{
		return $this->internalId;
	}
}