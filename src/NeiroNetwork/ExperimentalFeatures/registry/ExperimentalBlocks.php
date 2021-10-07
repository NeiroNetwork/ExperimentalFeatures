<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use pocketmine\block\Block;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static RAW_IRON_BLOCK()
 * @method static RAW_GOLD_BLOCK()
 * @method static CRIMSON_SLAB()
 * @method static CRIMSON_DOUBLE_SLAB()
 * @method static WARPED_SLAB()
 * @method static WARPED_DOUBLE_SLAB()
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
		// NOOP
	}
}