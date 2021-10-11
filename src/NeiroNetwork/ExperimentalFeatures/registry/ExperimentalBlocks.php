<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use pocketmine\block\Block;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static Block RAW_IRON_BLOCK()
 * @method static Block RAW_GOLD_BLOCK()
 * @method static Block CRIMSON_SLAB()
 * @method static Block CRIMSON_DOUBLE_SLAB()
 * @method static Block WARPED_SLAB()
 * @method static Block WARPED_DOUBLE_SLAB()
 * @method static Block BLACKSTONE_SLAB()
 * @method static Block BLACKSTONE_DOUBLE_SLAB()
 * @method static Block TINTED_GLASS()
 * @method static Block AMETHYST_BLOCK()
 * @method static Block DEEPSLATE()
 * @method static Block COBBLED_DEEPSLATE()
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