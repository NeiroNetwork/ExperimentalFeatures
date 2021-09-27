<?php

namespace NeiroNetwork\ExperimentalFeatures\override;

final class OverrideList{

	/** @return object[] */
	public static function get() : array{
		return [
			new IronOre(),
			new GoldOre(),
		];
	}
}