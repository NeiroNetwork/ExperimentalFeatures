<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use pocketmine\block\UnknownBlock;
use pocketmine\crafting\CraftingManagerFromDataHelper;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\crafting\ShapelessRecipeType;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\LegacyStringToItemParserException;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

/**
 * @see CraftingManagerFromDataHelper::make()
 */
class RecipesRegister{

	public static function registerAll(PluginBase $plugin) : void{
		self::register($plugin->getResource("recipes_1.17.json"));
		self::register($plugin->getResource("recipes_1.18.json"));
		self::register($plugin->getResource("recipes_1.19.json"));
		self::fixUnknownRecipes();
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
			$recipeType = match($recipe["block"]){
				"crafting_table" => ShapelessRecipeType::CRAFTING(),
				"stonecutter" => ShapelessRecipeType::STONECUTTER(),
				default => null
			};
			if($recipeType === null){
				continue;
			}
			try{
				$result->registerShapelessRecipe(new ShapelessRecipe(
					array_map($itemDeserializerFunc, $recipe["input"]),
					array_map($itemDeserializerFunc, $recipe["output"]),
					$recipeType
				));
			}catch(ItemNotFoundException){}
		}
		foreach($recipes["shaped"] as $recipe){
			if($recipe["block"] !== "crafting_table"){
				continue;
			}
			try{
				$result->registerShapedRecipe(new ShapedRecipe(
					$recipe["shape"],
					array_map($itemDeserializerFunc, $recipe["input"]),
					array_map($itemDeserializerFunc, $recipe["output"])
				));
			}catch(ItemNotFoundException){}
		}
		foreach($recipes["smelting"] as $recipe){
			$furnaceType = match ($recipe["block"]){
				"furnace" => FurnaceType::FURNACE(),
				"blast_furnace" => FurnaceType::BLAST_FURNACE(),
				"smoker" => FurnaceType::SMOKER(),
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
			}catch(ItemNotFoundException){}
		}
	}

	/**
	 * @throws ItemNotFoundException
	 */
	private static function itemJsonDeserialize(array $data) : Item{
		$toLegacy = \Closure::fromCallable([LegacyItemIdToStringIdMap::getInstance(), "stringToLegacy"]);
		$data["id"] = $toLegacy($data["id"]) ?? $toLegacy("minecraft:" . $data["id"]) ?? throw new ItemNotFoundException();
		return Item::jsonDeserialize($data);
	}

	/**
	 * 追加されてないアイテムをクラフトできるバグを修正する
	 */
	private static function fixUnknownRecipes() : void{
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
