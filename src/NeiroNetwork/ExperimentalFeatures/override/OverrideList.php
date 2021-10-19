<?php

namespace NeiroNetwork\ExperimentalFeatures\override;

final class OverrideList{

	/**
	 * TODO: 起動時の処理を少なくし、起動時のパフォーマンスを上げ
	 * TODO: より良い名前と実装方法を見つける
	 */
	public static function override() : void{
		new IronOre();
		new GoldOre();
		new Signs();
		new NetherWartBlock();
		new ButtonsAndPressurePlates();
		new ItemFrameBlock();
		new LanternBlock();
		new RedstoneOre();
	}
}