<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2\item;

use pocketmine\utils\EnumTrait;

/**
 * @method static FireworkType SMALL_SPHERE()
 * @method static FireworkType HUGE_SPHERE()
 * @method static FireworkType STAR()
 * @method static FireworkType CREEPER_HEAD()
 * @method static FireworkType BURST()
 */
final class FireworkType{
	use EnumTrait {
		__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new FireworkType("small_sphere", 0),
			new FireworkType("huge_sphere", 1),
			new FireworkType("star", 2),
			new FireworkType("creeper_head", 3),
			new FireworkType("burst", 4)
		);
	}

	private function __construct(
		string $enumName,
		private int $magicNumber
	){
		$this->Enum___construct($enumName);
	}

	public function getMagicNumber() : int{
		return $this->magicNumber;
	}
}
