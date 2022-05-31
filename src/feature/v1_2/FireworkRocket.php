<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\FireworksRocket;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\item\Fireworks;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\world\World;

class FireworkRocket extends Feature implements IItem{

	public function __construct(){
		parent::__construct();

		// FIXME: コンストラクタでEntityを登録するのはなんか間違えてる気がする
		EntityFactory::getInstance()->register(
			FireworksRocket::class,
			function(World $world, CompoundTag $nbt) : FireworksRocket{
				return new FireworksRocket(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
			},
			["FireworksRocket", EntityIds::FIREWORKS_ROCKET],
			EntityLegacyIds::FIREWORKS_ROCKET
		);
	}

	public function stringId() : string{
		// PocketMine-MP 内部では fireworks が使われている
		return "fireworks";
		// return "firework_rocket";
	}

	public function item() : Item{
		return new Fireworks($this->itemId(), $this->displayName());
	}
}