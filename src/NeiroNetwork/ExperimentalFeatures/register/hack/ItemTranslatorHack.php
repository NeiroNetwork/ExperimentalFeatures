<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\network\mcpe\convert\ItemTranslator;
use ReflectionClass;
use ReflectionProperty;

class ItemTranslatorHack{

	private ReflectionProperty $coreToNet;
	private ReflectionProperty $netToCore;

	public function __construct(){
		$reflection = new ReflectionClass(ItemTranslator::getInstance());

		$this->coreToNet = $reflection->getProperty("simpleCoreToNetMapping");
		$this->coreToNet->setAccessible(true);

		$this->netToCore = $reflection->getProperty("simpleNetToCoreMapping");
		$this->netToCore->setAccessible(true);
	}

	public function hack(int $internalItemId, int $runtimeId) : void{
		$translator = ItemTranslator::getInstance();

		$coreToNet = $this->coreToNet->getValue($translator);
		$coreToNet[$internalItemId] = $runtimeId;
		$this->coreToNet->setValue($translator, $coreToNet);

		$netToCore = $this->netToCore->getValue($translator);
		$netToCore[$runtimeId] = $internalItemId;
		$this->netToCore->setValue($translator, $netToCore);
	}
}