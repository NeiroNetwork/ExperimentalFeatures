<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\hack;

use pocketmine\network\mcpe\convert\GlobalItemTypeDictionary;
use pocketmine\network\mcpe\convert\R12ToCurrentBlockMapEntry;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\network\mcpe\protocol\serializer\NetworkNbtSerializer;
use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;
use pocketmine\network\mcpe\protocol\serializer\PacketSerializerContext;
use Webmozart\PathUtil\Path;

class RuntimeBlockMappingHack{

	public static function remap() : void{
		$map = RuntimeBlockMapping::getInstance();
		$method = (new \ReflectionClass($map))->getMethod("setupLegacyMappings");
		$method->setAccessible(true);
		$method->invoke($map);

		/** @var R12ToCurrentBlockMapEntry[] $legacyStateMap */
		$legacyStateMap = [];
		$legacyStateMapReader = PacketSerializer::decoder(file_get_contents(Path::join(\pocketmine\RESOURCE_PATH, "vanilla", "r12_to_current_block_map.bin")), 0, new PacketSerializerContext(GlobalItemTypeDictionary::getInstance()->getDictionary()));
		$nbtReader = new NetworkNbtSerializer();
		while(!$legacyStateMapReader->feof()){
			$id = $legacyStateMapReader->getString();
			$meta = $legacyStateMapReader->getLShort();

			$offset = $legacyStateMapReader->getOffset();
			$state = $nbtReader->read($legacyStateMapReader->getBuffer(), $offset)->mustGetCompoundTag();
			$legacyStateMapReader->setOffset($offset);
			$legacyStateMap[] = new R12ToCurrentBlockMapEntry($id, $meta, $state);
		}
		//var_dump($legacyStateMap);
	}

	public static function test() : void{
		$map = RuntimeBlockMapping::getInstance();
		$method = (new \ReflectionClass($map))->getMethod("registerMapping");
		$method->setAccessible(true);
		//$method->invoke($map, self::$counter++, 603, 0);

		$KEY = "minecraft:raw_iron_block";

		$idToStatesMap = [];
		foreach(RuntimeBlockMapping::getInstance()->getBedrockKnownStates() as $k => $state){
			$idToStatesMap[$state->getString("name")][] = $k;
		}

		foreach($idToStatesMap[$KEY] as $k){
			$method->invoke($map, $k, 603, 0);
		}
	}
}