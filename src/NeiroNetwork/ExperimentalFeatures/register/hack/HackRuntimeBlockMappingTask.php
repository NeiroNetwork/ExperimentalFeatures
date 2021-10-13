<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;

class HackRuntimeBlockMappingTask extends AsyncTask{

	private static array $mappingEntries;

	public static function setMappingEntries(array $entries) : void{
		self::$mappingEntries = $entries;
	}

	private /** @noinspection PhpMissingFieldTypeInspection */ $entries;

	public function __construct(){
		$this->entries = self::$mappingEntries;
	}

	public function onRun() : void{
		$mapping = RuntimeBlockMapping::getInstance();
		$method = (new \ReflectionClass($mapping))->getMethod("registerMapping");
		$method->setAccessible(true);
		foreach($this->entries as $entry){
			$method->invoke($mapping, ...$entry);
		}
	}
}