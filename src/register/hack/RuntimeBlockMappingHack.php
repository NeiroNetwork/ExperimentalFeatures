<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\UnknownBlock;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
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
			if($key >= 1 << Block::INTERNAL_METADATA_BITS) break;

			$this->registerMapping->invoke(RuntimeBlockMapping::getInstance(), $staticRuntimeId, $block->getId(), $key);
			RuntimeBlockMappingHackTask::addHackArgs([$staticRuntimeId, $block->getId(), $key]);

			if(BlockFactory::getInstance()->get($block->getId(), $key) instanceof UnknownBlock){
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
