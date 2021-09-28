<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

final class NewFeatures{

	/** @return object[] */
	public static function get() : array{
		return [
			new RawIron(),
			new RawGold(),
			new RawIronBlock(),
			new RawGoldBlock(),
			new GlowInkSac(),
		];
	}
}