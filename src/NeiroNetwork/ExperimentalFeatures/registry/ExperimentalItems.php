<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\registry;

use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static FLOWERING_AZALEA()
 */
class ExperimentalItems{
	use CloningRegistryTrait;

	public static function register(string $name, Item $item) : void{
		self::_registryRegister($name, $item);
	}

	public static function fromString(string $name) : Item{
		$result = self::_registryFromString($name);
		assert($result instanceof Item);
		return $result;
	}

	/**
	 * @return Item[]
	 */
	public static function getAll() : array{
		return self::_registryGetAll();
	}

	protected static function setup() : void{
		// NOOP
	}
}