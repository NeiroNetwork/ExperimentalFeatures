<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\block;

use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemIds;
use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\Opaque;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static Opaque RAW_IRON()
 * @method static Opaque RAW_GOLD()
 */
class ExperimentalBlocks{
	use CloningRegistryTrait;

	public static function register(string $name, Block $block) : void{
		self::_registryRegister($name, $block);
	}

	public static function fromString(string $name) : Block{
		$result = self::_registryFromString($name);
		assert($result instanceof Block);
		return $result;
	}

	/**
	 * @return Block[]
	 */
	public static function getAll() : array{
		return self::_registryGetAll();
	}

	protected static function setup() : void{
		$factory = BlockFactory::getInstance();
		self::register("raw_iron", $factory->get(ExperimentalItemIds::RAW_IRON_BLOCK));
		self::register("raw_gold", $factory->get(ExperimentalItemIds::RAW_GOLD_BLOCK));
	}
}