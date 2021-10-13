<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use pocketmine\block\UnknownBlock;
use pocketmine\crafting\CraftingManagerFromDataHelper;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

/**
 * @see CraftingManagerFromDataHelper::make()
 */
class RecipesRegister{

	public static function registerAll(PluginBase $plugin) : void{
		self::register($plugin->getResource("recipes_1.17.json"));
		self::fixRecipes();
	}

	/**
	 * @param resource $resource
	 * @see CraftingManagerFromDataHelper::make()
	 */
	private static function register($resource) : void{
		$recipes = json_decode(stream_get_contents($resource), true);
		fclose($resource);
		$result = Server::getInstance()->getCraftingManager();
		$itemDeserializerFunc = \Closure::fromCallable([self::class, "itemJsonDeserialize"]);

		foreach($recipes["shapeless"] as $recipe){
			if($recipe["block"] !== "crafting_table"){ //TODO: filter others out for now to avoid breaking economics
				continue;
			}
			try{
				$result->registerShapelessRecipe(new ShapelessRecipe(
					array_map($itemDeserializerFunc, $recipe["input"]),
					array_map($itemDeserializerFunc, $recipe["output"])
				));
			}/** @noinspection PhpRedundantCatchClauseInspection */catch(ItemNotFoundException){
			}
		}
		foreach($recipes["shaped"] as $recipe){
			if($recipe["block"] !== "crafting_table"){ //TODO: filter others out for now to avoid breaking economics
				continue;
			}
			try{
				$result->registerShapedRecipe(new ShapedRecipe(
					$recipe["shape"],
					array_map($itemDeserializerFunc, $recipe["input"]),
					array_map($itemDeserializerFunc, $recipe["output"])
				));
			}/** @noinspection PhpRedundantCatchClauseInspection */catch(ItemNotFoundException){
			}
		}
		foreach($recipes["smelting"] as $recipe){
			$furnaceType = match ($recipe["block"]){
				"furnace" => FurnaceType::FURNACE(),
				"blast_furnace" => FurnaceType::BLAST_FURNACE(),
				"smoker" => FurnaceType::SMOKER(),
				//TODO: campfire
				default => null
			};
			if($furnaceType === null){
				continue;
			}
			try{
				$result->getFurnaceRecipeManager($furnaceType)->register(new FurnaceRecipe(
					$itemDeserializerFunc($recipe["output"]),
					$itemDeserializerFunc($recipe["input"])
				));
			}/** @noinspection PhpRedundantCatchClauseInspection */catch(ItemNotFoundException){
			}
		}
	}

	/**
	 * @throws ItemNotFoundException
	 */
	private static function itemJsonDeserialize(array $data) : Item{
		$data["id"] = LegacyItemIdToStringIdMap::getInstance()->stringToLegacy($data["id"]);
		if($data["id"] === null){
			throw new ItemNotFoundException();
		}
		return Item::jsonDeserialize($data);
	}

	/**
	 * 追加されてないアイテムをクラフトできるバグを修正する
	 */
	private static function fixRecipes() : void{
		$craftingManager = Server::getInstance()->getCraftingManager();
		$reflectedShapedRecipes = (new \ReflectionClass($craftingManager))->getProperty("shapedRecipes");
		$reflectedShapedRecipes->setAccessible(true);
		$reflectedShapelessRecipes = (new \ReflectionClass($craftingManager))->getProperty("shapelessRecipes");
		$reflectedShapelessRecipes->setAccessible(true);

		foreach($shapedRecipesValue = $craftingManager->getShapedRecipes() as $hash => $shapedRecipes){
			foreach($shapedRecipes as $key => $shapedRecipe){
				foreach($shapedRecipe->getResults() as $item){
					if($item instanceof ItemBlock && $item->getBlock() instanceof UnknownBlock){
						unset($shapedRecipesValue[$hash][$key]);
					}
				}
			}
		}
		$reflectedShapedRecipes->setValue($craftingManager, $shapedRecipesValue);

		foreach($shapelessRecipesValue = $craftingManager->getShapelessRecipes() as $hash => $shapelessRecipes){
			foreach($shapelessRecipes as $key => $shapelessRecipe){
				foreach($shapelessRecipe->getResults() as $item){
					if($item instanceof ItemBlock && $item->getBlock() instanceof UnknownBlock){
						unset($shapelessRecipesValue[$hash][$key]);
					}
				}
			}
		}
		$reflectedShapelessRecipes->setValue($craftingManager, $shapelessRecipesValue);
	}
}