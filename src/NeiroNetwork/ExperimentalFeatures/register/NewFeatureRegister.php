<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\block\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\hack\BlameChunkRequestTask;
use NeiroNetwork\ExperimentalFeatures\hack\BlockMappingHack;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\new\interface\Craftable;
use NeiroNetwork\ExperimentalFeatures\new\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\new\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\new\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\StringToItemParser;
use pocketmine\Server;

class NewFeatureRegister{

	private BlockMappingHack $blockMappingHack;
	private ItemTranslatorHack $itemTranslatorHack;
	private BlameChunkRequestTask $blameChunkRequestTask;

	public function __construct(){
		$this->blockMappingHack = new BlockMappingHack();
		$this->itemTranslatorHack = new ItemTranslatorHack();
		$this->blameChunkRequestTask = new BlameChunkRequestTask();
	}

	public function __destruct(){
		echo get_class($this) . "::__destruct()\n";
		$this->blameChunkRequestTask->doHack();
	}

	public function register(object $feature) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			ExperimentalBlocks::register($feature->name(), BlockFactory::getInstance()->get($feature->internalId()));
			$this->blockMappingHack->hack("minecraft:" . $feature->name(), ExperimentalBlocks::fromString($feature->name()));
			$this->blameChunkRequestTask->add("minecraft:" . $feature->name(), ExperimentalBlocks::fromString($feature->name()));
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			ExperimentalItems::register($feature->name(), ItemFactory::getInstance()->get($feature->internalId()));
			StringToItemParser::getInstance()->register($feature->name(), fn() => ExperimentalItems::fromString($feature->name()));
			$this->itemTranslatorHack->hack($feature->internalId(), $feature->networkId());
			CreativeInventory::getInstance()->add(ExperimentalItems::fromString($feature->name()));
		}

		$craftingManager = Server::getInstance()->getCraftingManager();
		if($feature instanceof Craftable){
			if(($recipe = $feature->recipe()) instanceof ShapedRecipe){
				$craftingManager->registerShapedRecipe($recipe);
			}elseif($recipe instanceof ShapelessRecipe){
				$craftingManager->registerShapelessRecipe($recipe);
			}
		}
		if($feature instanceof Smeltable){
			$craftingManager->getFurnaceRecipeManager(FurnaceType::FURNACE())->register($feature->furnace());
		}
		if($feature instanceof Smeltable2){
			$craftingManager->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE())->register($feature->furnace());
		}
	}
}
