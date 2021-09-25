<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack\blamepmmp;

use pocketmine\block\Block;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class BlameChunkRequestTask{

	private static array $queue;

	public static function add(string $name, Block $block) : void{
		self::$queue[] = [$name, $block->getId()];
	}

	public static function doHack() : void{
		$pool = Server::getInstance()->getAsyncPool();
		for($i = 0; $i < $pool->getSize(); ++$i){
			$pool->submitTaskToWorker(new class(self::$queue) extends AsyncTask{
				public function __construct(array $queue){
					$this->queue = $queue;
				}
				public function onRun() : void{
					$map = RuntimeBlockMapping::getInstance();
					$method = (new \ReflectionClass($map))->getMethod("registerMapping");
					$method->setAccessible(true);
					$idToStatesMap = [];
					foreach($map->getBedrockKnownStates() as $k => $state) $idToStatesMap[$state->getString("name")][] = $k;
					foreach($this->queue as $hackValue){
						foreach($idToStatesMap[$hackValue[0]] as $key => $staticRuntimeId){
							$method->invoke($map, $staticRuntimeId, $hackValue[1], $key);
						}
					}
				}
			}, $i);
		}
	}
}