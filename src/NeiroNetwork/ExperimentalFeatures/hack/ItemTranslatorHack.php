<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\network\mcpe\convert\ItemTranslator;

class ItemTranslatorHack{

	private \ReflectionProperty $coreToNet;
	private \ReflectionProperty $netToCore;

	public function __construct(){
		$translator = ItemTranslator::getInstance();
		$reflection = new \ReflectionClass($translator);

		$this->coreToNet = $reflection->getProperty("simpleCoreToNetMapping");
		$this->coreToNet->setAccessible(true);

		$this->netToCore = $reflection->getProperty("simpleNetToCoreMapping");
		$this->netToCore->setAccessible(true);
	}

	public function hack(int $internal, int $network) : void{
		$translator = ItemTranslator::getInstance();

		$value = $this->coreToNet->getValue($translator);
		$value[$internal] = $network;
		$this->coreToNet->setValue($translator, $value);

		$value = $this->netToCore->getValue($translator);
		$value[$network] = $internal;
		$this->netToCore->setValue($translator, $value);
	}
}