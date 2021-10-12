<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register\hack;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\UnknownBlock;
use pocketmine\block\Wall;
use pocketmine\data\bedrock\LegacyBlockIdToStringIdMap;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class BlockMappingHack{

	private array $idToStatesMap = [];

	private ReflectionMethod $registerMapping;
	private ReflectionProperty $legacyToString;
	private ReflectionProperty $stringToLegacy;

	private array $modifiedMappingEntries = [];

	public function __construct(){
		$mapping = RuntimeBlockMapping::getInstance();
		foreach($mapping->getBedrockKnownStates() as $key => $state){
			$this->idToStatesMap[$state->getString("name")][] = $key;
		}
		$this->registerMapping = (new ReflectionClass($mapping))->getMethod("registerMapping");
		$this->registerMapping->setAccessible(true);

		$parent = (new ReflectionClass(LegacyBlockIdToStringIdMap::getInstance()))->getParentClass();
		$this->legacyToString = $parent->getProperty("legacyToString");
		$this->legacyToString->setAccessible(true);
		$this->stringToLegacy = $parent->getProperty("stringToLegacy");
		$this->stringToLegacy->setAccessible(true);
	}

	public function hack(string $name, Block $block) : void{
		foreach($this->idToStatesMap[$name] as $key => $staticRuntimeId){
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

		$mapping = LegacyBlockIdToStringIdMap::getInstance();
		$legacyToString = $this->legacyToString->getValue($mapping);
		$legacyToString[$block->getId()] = $name;
		$this->legacyToString->setValue($mapping, $legacyToString);

		$stringToLegacy = $this->stringToLegacy->getValue($mapping);
		$stringToLegacy[$name] = $block->getId();
		$this->stringToLegacy->setValue($mapping, $stringToLegacy);
	}

	public function __destruct(){
		// Hack for ChunkRequestTask
		$asyncPool = Server::getInstance()->getAsyncPool();
		for($i = 0; $i < $asyncPool->getSize(); ++$i){
			$asyncPool->submitTaskToWorker(new class($this->modifiedMappingEntries) extends AsyncTask{
				public function __construct(private array $entries){}
				public function onRun() : void{
					$mapping = RuntimeBlockMapping::getInstance();
					$method = (new \ReflectionClass($mapping))->getMethod("registerMapping");
					$method->setAccessible(true);
					foreach($this->entries as $entry){
						$method->invoke($mapping, ...$entry);
					}
				}
			}, $i);
		}
	}
}