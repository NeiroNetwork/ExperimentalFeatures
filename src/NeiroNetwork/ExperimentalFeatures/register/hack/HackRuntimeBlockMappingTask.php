<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;
use ReflectionClass;
use Volatile;

class HackRuntimeBlockMappingTask extends AsyncTask{

	private Volatile $entries;

	public function __construct($entries){
		$this->entries = $entries;
	}

	public function onRun() : void{
		$mapping = RuntimeBlockMapping::getInstance();
		$method = (new ReflectionClass($mapping))->getMethod("registerMapping");
		$method->setAccessible(true);
		foreach($this->entries as $entry){
			$method->invoke($mapping, ...$entry);
		}
	}
}