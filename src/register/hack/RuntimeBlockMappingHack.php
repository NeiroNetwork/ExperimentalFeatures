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
		Server::getInstance()->getAsyncPool()->addWorkerStartHook(function(int $worker) : void{
			Server::getInstance()->getAsyncPool()->submitTaskToWorker(new RuntimeBlockMappingHackTask(), $worker);
		});
	}
}
