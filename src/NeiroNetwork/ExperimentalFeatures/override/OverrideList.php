<?php

namespace NeiroNetwork\ExperimentalFeatures\override;

final class OverrideList{

	public static function override() : void{
		new IronOre();
		new GoldOre();
		new Signs();
	}
}