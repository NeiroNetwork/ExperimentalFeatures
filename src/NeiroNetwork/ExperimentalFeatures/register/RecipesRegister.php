<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use Closure;
use pocketmine\crafting\CraftingManagerFromDataHelper;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

/**
 * @see CraftingManagerFromDataHelper::make()
 */
class RecipesRegister{

	public static function registerAll(PluginBase $plugin) : void{
		self::register($plugin->getResource("recipes_1.17.json"));
	}

	/**
	 * @param resource $resource
	 * @see CraftingManagerFromDataHelper::make()
	 */
	private static function register($resource) : void{
		$recipes = json_decode(stream_get_contents($resource), true);
		fclose($resource);
		$result = Server::getInstance()->getCraftingManager();
		$itemDeserializerFunc = Closure::fromCallable([Item::class, 'jsonDeserialize']);

		foreach($recipes["shapeless"] as $recipe){
			if($recipe["block"] !== "crafting_table"){ //TODO: filter others out for now to avoid breaking economics
				continue;
			}
			$result->registerShapelessRecipe(new ShapelessRecipe(
				array_map($itemDeserializerFunc, $recipe["input"]),
				array_map($itemDeserializerFunc, $recipe["output"])
			));
		}
		foreach($recipes["shaped"] as $recipe){
			if($recipe["block"] !== "crafting_table"){ //TODO: filter others out for now to avoid breaking economics
				continue;
			}
			$result->registerShapedRecipe(new ShapedRecipe(
				$recipe["shape"],
				array_map($itemDeserializerFunc, $recipe["input"]),
				array_map($itemDeserializerFunc, $recipe["output"])
			));
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
			$result->getFurnaceRecipeManager($furnaceType)->register(new FurnaceRecipe(
					Item::jsonDeserialize($recipe["output"]),
					Item::jsonDeserialize($recipe["input"]))
			);
		}
	}
}