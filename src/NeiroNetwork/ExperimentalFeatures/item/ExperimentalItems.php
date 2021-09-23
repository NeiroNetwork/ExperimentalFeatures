<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\item;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static Item RAW_IRON()
 * @method static Item RAW_GOLD()
 * @method static GlowInkSac GLOW_INK_SAC()
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
		$factory = ItemFactory::getInstance();
		self::register("raw_iron", $factory->get(ExperimentalItemIds::RAW_IRON));
		self::register("raw_gold", $factory->get(ExperimentalItemIds::RAW_GOLD));
		self::register("glow_ink_sac", $factory->get(ExperimentalItemIds::GLOW_INK_SAC));
	}
}