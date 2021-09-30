<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\hack\BlameChunkRequestTask;
use NeiroNetwork\ExperimentalFeatures\hack\BlockMappingHack;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\crafting\FurnaceRecipe;
use pocketmine\crafting\FurnaceType;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
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
		$this->blameChunkRequestTask->doHack();
	}

	public function register(Feature $feature) : void{
		if($feature instanceof IBlock){
			BlockFactory::getInstance()->register($feature->block());
			ExperimentalBlocks::register($feature->name(), BlockFactory::getInstance()->get($feature->internalId(), 0));
			$this->blockMappingHack->hack("minecraft:" . $feature->name(), ExperimentalBlocks::fromString($feature->name()));
			$this->blameChunkRequestTask->add("minecraft:" . $feature->name(), ExperimentalBlocks::fromString($feature->name()));

			// (ブロックはほとんどの場合アイテムとしても存在するので) アイテムも登録する
			ItemFactory::getInstance()->register(new ItemBlock(new ItemIdentifier($feature->internalId(), 0), ExperimentalBlocks::fromString($feature->name())));
			StringToItemParser::getInstance()->registerBlock($feature->name(), \Closure::fromCallable([ExperimentalBlocks::class, "fromString"]));
			$this->itemTranslatorHack->hack($feature->internalId(), $feature->networkId());
			CreativeInventory::getInstance()->add(ExperimentalBlocks::fromString($feature->name())->asItem());
		}

		if($feature instanceof IItem){
			ItemFactory::getInstance()->register($feature->item());
			ExperimentalItems::register($feature->name(), ItemFactory::getInstance()->get($feature->internalId()));
			StringToItemParser::getInstance()->register($feature->name(), \Closure::fromCallable([ExperimentalItems::class, "fromString"]));
			$this->itemTranslatorHack->hack($feature->internalId(), $feature->networkId());
			CreativeInventory::getInstance()->add(ExperimentalItems::fromString($feature->name()));
		}
	}

	/**
	 * レシピ用 (アイテムやブロックを全て登録してから実行する必要がある)
	 */
	public function register2(Feature $feature) : void{
		$craftingManager = Server::getInstance()->getCraftingManager();
		if($feature instanceof HasRecipe){
			foreach($feature->recipe() as $recipe){
				if($recipe instanceof ShapedRecipe){
					$craftingManager->registerShapedRecipe($recipe);
				}elseif($recipe instanceof ShapelessRecipe){
					$craftingManager->registerShapelessRecipe($recipe);
				}elseif($recipe instanceof FurnaceRecipe){
					if($feature instanceof Smeltable){
						$craftingManager->getFurnaceRecipeManager(FurnaceType::FURNACE())->register($recipe);
					}
					if($feature instanceof Smeltable2){
						$craftingManager->getFurnaceRecipeManager(FurnaceType::BLAST_FURNACE())->register($recipe);
					}
				}
			}
		}
	}
}