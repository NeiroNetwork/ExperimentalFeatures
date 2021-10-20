<?php /** @noinspection PhpDeprecationInspection */

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\override\expert\assets;

use pocketmine\block\tile\Sign;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;

class TileSign extends Sign{

	public const TAG_TEXT_GLOWING = "TextIgnoreLegacyBugResolved";
	// public const TAG_UNKNOWN = "IgnoreLighting";

	protected bool $glowing = false;

	public function isGlowing() : bool{
		return $this->glowing;
	}

	public function setGlowing(bool $glowing) : void{
		$this->glowing = $glowing;
	}

	public function readSaveData(CompoundTag $nbt) : void{
		parent::readSaveData($nbt);
		if(($tag = $nbt->getTag(self::TAG_TEXT_GLOWING)) instanceof ByteTag){
			$this->glowing = $tag->getValue() === 1;
		}
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		parent::writeSaveData($nbt);
		if($this->glowing){
			$nbt->setByte(self::TAG_TEXT_GLOWING, 1);
		}
	}

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		parent::addAdditionalSpawnData($nbt);
		if($this->glowing){
			$nbt->setByte(self::TAG_TEXT_GLOWING, 1);
		}
	}
}