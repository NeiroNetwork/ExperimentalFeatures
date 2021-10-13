<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

class PmmpHacks{

	public RuntimeBlockMappingHack $runtimeBlockMapping;
	public ItemTranslatorHack $itemTranslator;
	public LegacyBlockIdToStringIdMapHack $legacyBlockIdToStringIdMap;
	public LegacyItemIdToStringIdMapHack $legacyItemIdToStringIdMap;

	public function __construct(){
		$this->runtimeBlockMapping = new RuntimeBlockMappingHack();
		$this->itemTranslator = new ItemTranslatorHack();
		$this->legacyBlockIdToStringIdMap = new LegacyBlockIdToStringIdMapHack();
		$this->legacyItemIdToStringIdMap = new LegacyItemIdToStringIdMapHack();
	}
}