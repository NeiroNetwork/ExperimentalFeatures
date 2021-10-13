<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\UnknownBlock;
use pocketmine\block\Wall;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\Server;
use ReflectionClass;
use ReflectionMethod;

class RuntimeBlockMappingHack{

	private array $idToStatesMap = [];
	private ReflectionMethod $registerMapping;
	private array $modifiedMappingEntries = [];

	public function __construct(){
		$mapping = RuntimeBlockMapping::getInstance();
		foreach($mapping->getBedrockKnownStates() as $key => $state){
			$this->idToStatesMap[$state->getString("name")][] = $key;
		}
		$this->registerMapping = (new ReflectionClass($mapping))->getMethod("registerMapping");
		$this->registerMapping->setAccessible(true);
	}

	public function hack(string $fullStringId, Block $block) : void{
		foreach($this->idToStatesMap[$fullStringId] as $key => $staticRuntimeId){
			$this->registerMapping->invoke(RuntimeBlockMapping::getInstance(), $staticRuntimeId, $block->getId(), $key);
			$this->modifiedMappingEntries[] = [$staticRuntimeId, $block->getId(), $key];

			if($block instanceof Wall){
				// バニラの石の壁は種類がありすぎて登録できない, PocketMine-MPが石の壁に対応していない
				break;
			}

			if(BlockFactory::getInstance()->get($block->getId(), $key) instanceof UnknownBlock){
				$newBlock = new ($block::class)(
					new BlockIdentifier($block->getId(), $key, $block->getIdInfo()->getItemId(), $block->getIdInfo()->getTileClass()),
					$block->getName(),
					$block->getBreakInfo()
				);
				BlockFactory::getInstance()->register($newBlock);
			}
		}
	}

	public function __destruct(){
		// Hack for ChunkRequestTask
		$asyncPool = Server::getInstance()->getAsyncPool();
		for($i = 0; $i < $asyncPool->getSize(); ++$i){
			$asyncPool->submitTaskToWorker(new HackRuntimeBlockMappingTask($this->modifiedMappingEntries), $i);
		}
	}
}