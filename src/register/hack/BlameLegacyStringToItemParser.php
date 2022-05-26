<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use pocketmine\item\LegacyStringToItemParser;

class BlameLegacyStringToItemParser{

	private LegacyStringToItemParser $parser;

	public function __construct(){
		$this->parser = LegacyStringToItemParser::getInstance();
	}

	/**
	 * LegacyStringToItemParser はアイテムをパースするためのクラスなのに、ブロックもパースしようとするゴミ実装が存在するので
	 * そのゴミ実装にある程度対応できるように、数字IDのブロックがマッピング可能であればブロックアイテムをマッピングする
	 */
	public function registerBlock(Feature $feature) : bool{
		if(isset($this->parser->getMappings()[$feature->blockId()->getBlockId()])){
			return false;
		}

		$this->parser->addMapping((string) $feature->blockId()->getBlockId(), $feature->itemId()->getId());
		return true;
	}
}