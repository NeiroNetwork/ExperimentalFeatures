<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2\item;

use pocketmine\utils\EnumTrait;

/**
 * @method static FireworkColor BLACK()
 * @method static FireworkColor RED()
 * @method static FireworkColor GREEN()
 * @method static FireworkColor BROWN()
 * @method static FireworkColor BLUE()
 * @method static FireworkColor PURPLE()
 * @method static FireworkColor CYAN()
 * @method static FireworkColor LIGHT_GRAY()
 * @method static FireworkColor GRAY()
 * @method static FireworkColor PINK()
 * @method static FireworkColor LIME()
 * @method static FireworkColor YELLOW()
 * @method static FireworkColor LIGHT_BLUE()
 * @method static FireworkColor MAGENTA()
 * @method static FireworkColor ORANGE()
 * @method static FireworkColor WHITE()
 */
final class FireworkColor{
	use EnumTrait {
		__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new FireworkColor("black", "Black", "\x00"),
			new FireworkColor("red", "Red", "\x01"),
			new FireworkColor("green", "Green", "\x02"),
			new FireworkColor("brown", "Brown", "\x03"),
			new FireworkColor("blue", "Blue", "\x04"),
			new FireworkColor("purple", "Purple", "\x05"),
			new FireworkColor("cyan", "Cyan", "\x06"),
			new FireworkColor("light_gray", "Light Gray", "\x07"),
			new FireworkColor("gray", "Gray", "\x08"),
			new FireworkColor("pink", "Pink", "\x09"),
			new FireworkColor("lime", "Lime", "\x0a"),
			new FireworkColor("yellow", "Yellow", "\x0b"),
			new FireworkColor("light_blue", "Light Blue", "\x0c"),
			new FireworkColor("magenta", "Magenta", "\x0d"),
			new FireworkColor("orange", "Orange", "\x0e"),
			new FireworkColor("white", "White", "\x0f")
		);
	}

	private function __construct(
		string $enumName,
		private string $displayName,
		private string $magicChar
	){
		$this->Enum___construct($enumName);
	}

	public function getDisplayName() : string{
		return $this->displayName;
	}

	public function getMagicChar() : string{
		return $this->magicChar;
	}
}
