<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\UnknownBlock;
use pocketmine\block\Wall;
use pocketmine\event\EventPriority;
use pocketmine\event\server\LowMemoryEvent;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class RuntimeBlockMappingHack{

	private array $idToStatesMap = [];
	private \ReflectionMethod $registerMapping;

	public function __construct(){
		$mapping = RuntimeBlockMapping::getInstance();
		foreach($mapping->getBedrockKnownStates() as $key => $state){
			$this->idToStatesMap[$state->getString("name")][] = $key;
		}
		$this->registerMapping = (new \ReflectionClass($mapping))->getMethod("registerMapping");
		$this->registerMapping->setAccessible(true);
	}

	/**
	 * @return Block[]
	 */
	public function hack(string $fullStringId, Block $block) : array{
		$registeredNewBlocks = [];

		foreach($this->idToStatesMap[$fullStringId] as $key => $staticRuntimeId){
			$this->registerMapping->invoke(RuntimeBlockMapping::getInstance(), $staticRuntimeId, $block->getId(), $key);
			RuntimeBlockMappingHackTask::addHackArgs([$staticRuntimeId, $block->getId(), $key]);

			if($block instanceof Wall){
				// バニラの石の壁は種類がありすぎて登録できない, PocketMine-MPが石の壁に対応していない
				break;
			}

			if($key < 16 && BlockFactory::getInstance()->get($block->getId(), $key) instanceof UnknownBlock){
				$registeredNewBlocks[] = $newBlock = new ($block::class)(
					new BlockIdentifier($block->getId(), $key, $block->getIdInfo()->getItemId(), $block->getIdInfo()->getTileClass()),
					$block->getName(),
					$block->getBreakInfo()
				);
				BlockFactory::getInstance()->register($newBlock);
			}
		}

		return $registeredNewBlocks;
	}

	public function __destruct(){
		// Hack for ChunkRequestTask
		$runtimeBlockMappingAsyncHack = function() : void{
			$asyncPool = Server::getInstance()->getAsyncPool();
			for($i = 0; $i < $asyncPool->getSize(); ++$i){
				$asyncPool->submitTaskToWorker(new RuntimeBlockMappingHackTask(), $i);
			}
		};
		$runtimeBlockMappingAsyncHack();

		$pluginManager = Server::getInstance()->getPluginManager();
		$plugin = $pluginManager->getPlugin("ExperimentalFeatures");
		$scheduler = $plugin->getScheduler();

		// MemoryManagerのGCのタイミングで再度hackしなおす
		$config = Server::getInstance()->getConfigGroup();
		$garbageCollectionPeriod = $config->getPropertyInt("memory.garbage-collection.period", 36000);
		$garbageCollectionAsync = $config->getPropertyBool("memory.garbage-collection.collect-async-worker", true);
		if($garbageCollectionPeriod > 0 && $garbageCollectionAsync){
			$scheduler->scheduleDelayedRepeatingTask(new ClosureTask($runtimeBlockMappingAsyncHack), $garbageCollectionPeriod + 1, $garbageCollectionPeriod);
		}

		// LowMemoryEvent をリッスンする
		$pluginManager->registerEvent(
			LowMemoryEvent::class,
			fn(LowMemoryEvent $e) => $scheduler->scheduleDelayedTask(new ClosureTask($runtimeBlockMappingAsyncHack), 1),
			EventPriority::NORMAL,
			$plugin
		);
	}
}