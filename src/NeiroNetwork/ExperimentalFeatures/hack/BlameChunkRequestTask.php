<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\block\Block;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class BlameChunkRequestTask{

	/** @var Block[] $queue */
	private array $queue = [];

	public function add(string $name, Block $block) : void{
		$this->queue[$name] = $block->getId();
	}

	public function doHack() : void{
		$pool = Server::getInstance()->getAsyncPool();
		for($i = 0; $i < $pool->getSize(); ++$i){
			$pool->submitTaskToWorker(new class($this->queue) extends AsyncTask{
				private $queue;
				public function __construct(array $queue){
					$this->queue = $queue;
				}
				public function onRun() : void{
					$map = RuntimeBlockMapping::getInstance();
					$method = (new \ReflectionClass($map))->getMethod("registerMapping");
					$method->setAccessible(true);
					$idToStatesMap = [];
					foreach($map->getBedrockKnownStates() as $k => $state) $idToStatesMap[$state->getString("name")][] = $k;
					foreach($this->queue as $name => $block){
						foreach($idToStatesMap[$name] as $key => $staticRuntimeId){
							$method->invoke($map, $staticRuntimeId, $block, $key);
						}
					}
				}
			}, $i);
		}
	}
}