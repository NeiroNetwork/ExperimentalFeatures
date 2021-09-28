<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\new;

final class NewFeatures{

	/** @return Feature[] */
	public static function get() : array{
		// 要素の順番で内部IDが決定するので並び変えてはいけない
		return [
			new RawIron(),
			new RawGold(),
			new RawIronBlock(),
			new RawGoldBlock(),
			new GlowInkSac(),
			new AmethystBlock(),
			new BuddingAmethyst(),
			new AmethystShard(),
			new LargeAmethystBud(),
			new MediumAmethystBud(),
			new SmallAmethystBud(),
			new AmethystCluster(),
		];
	}
}