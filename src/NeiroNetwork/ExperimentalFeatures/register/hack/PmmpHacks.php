<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

class PmmpHacks{

	public RuntimeBlockMappingHack $runtimeBlockMapping;
	public ItemTranslatorHack $itemTranslator;
	public LegacyBlockIdToStringIdMapHack $legacyBlockIdToStringIdMap;
	public LegacyItemIdToStringIdMapHack $legacyItemIdToStringIdMap;
	public BlameLegacyStringToItemParser $blameLegacyStringToItemParser;
	public VanillaBlocksHack $vanillaBlocksHack;
	public VanillaItemsHack $vanillaItemsHack;

	public function __construct(){
		$this->runtimeBlockMapping = new RuntimeBlockMappingHack();
		$this->itemTranslator = new ItemTranslatorHack();
		$this->legacyBlockIdToStringIdMap = new LegacyBlockIdToStringIdMapHack();
		$this->legacyItemIdToStringIdMap = new LegacyItemIdToStringIdMapHack();
		$this->blameLegacyStringToItemParser = new BlameLegacyStringToItemParser();
		$this->vanillaBlocksHack = new VanillaBlocksHack();
		$this->vanillaItemsHack = new VanillaItemsHack();
	}
}