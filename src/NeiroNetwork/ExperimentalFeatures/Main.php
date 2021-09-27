<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlockFactory;
use NeiroNetwork\ExperimentalFeatures\block\tile\ExperimentalTileFactory;
use NeiroNetwork\ExperimentalFeatures\crafting\CraftingRecipeInitializer;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\item\ExperimentalItemFactory;
use NeiroNetwork\ExperimentalFeatures\new\interface\Craftable;
use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\new\RawIron;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onEnable() : void{
		/*
		ExperimentalBlockFactory::init();
		ExperimentalItemFactory::init();
		ExperimentalTileFactory::init();
		CraftingRecipeInitializer::init();
		*/

		$list = [
			new RawIron(),
		];

		ItemTranslatorHack::prepare();
		foreach($list as $feature){
			if($feature instanceof IBlock){
				// TODO
			}
			if($feature instanceof IItem){
				ItemFactory::getInstance()->register($feature->item());
				ExperimentalItems::register($feature->name(), ItemFactory::getInstance()->get($feature->internalId()));
				StringToItemParser::getInstance()->register($feature->name(), fn() => ExperimentalItems::fromString($feature->name()));
				ItemTranslatorHack::hack($feature->internalId(), $feature->networkId());
				CreativeInventory::getInstance()->add(ExperimentalItems::fromString($feature->name()));
			}
			if($feature instanceof Craftable){
				if(($recipe = $feature->recipe()) instanceof ShapedRecipe){
					$this->getServer()->getCraftingManager()->registerShapedRecipe($recipe);
				}elseif($recipe instanceof ShapelessRecipe){
					$this->getServer()->getCraftingManager()->registerShapelessRecipe($recipe);
				}
			}
			if($feature instanceof Smeltable){
				$this->getServer()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::FURNACE())->register($feature->furnace());
			}
			if($feature instanceof Smeltable2){
				$this->getServer()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE())->register($feature->furnace());
			}
		}
	}
}