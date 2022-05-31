<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature\v1_2;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interfaces\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\entity\FireworksRocket;
use NeiroNetwork\ExperimentalFeatures\feature\v1_2\item\Fireworks;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\Server;
use pocketmine\world\World;

class FireworkRocket extends Feature implements IItem{

	public function __construct(){
		parent::__construct();
	}

	public function stringId() : string{
		// PocketMine-MP 内部では fireworks が使われている
		return "fireworks";
		// return "firework_rocket";
	}

	public function item() : Item{
		return new Fireworks($this->itemId(), $this->displayName());
	}

	public function afterRegistration() : void{
		EntityFactory::getInstance()->register(
			FireworksRocket::class,
			function(World $world, CompoundTag $nbt) : FireworksRocket{
				return new FireworksRocket(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
			},
			["FireworksRocket", EntityIds::FIREWORKS_ROCKET],
			EntityLegacyIds::FIREWORKS_ROCKET
		);

		$crafting = Server::getInstance()->getCraftingManager();
		$fireworks = $this->item();
		$gunpowder = VanillaItems::GUNPOWDER();
		foreach($crafting->getShapelessRecipes() as $shapelessRecipes){
			foreach($shapelessRecipes as $recipe){
				$result = $recipe->getResults()[0];
				if($result->equals($fireworks, checkCompound: false)){
					for($i = 2; $i <= 3; $i++){
						// (何故か分からないが) アイテムのメタが-1になっているので、ダメージなどをチェックしないようにする
						$newList = array_map(fn($item) => $item->equals($gunpowder, false, false) ? $item->setCount($i) : $item, $recipe->getIngredientList());
						$newItem = clone $result;
						$newItem->getNamedTag()->getCompoundTag("Fireworks")->setByte("Flight", $i);
						$crafting->registerShapelessRecipe(new ShapelessRecipe($newList, [$newItem]));
					}
				}
			}
		}
	}
}