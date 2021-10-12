<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\feature;

use NeiroNetwork\ExperimentalFeatures\feature\interface\HasRecipe;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlock;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IBlockOnly;
use NeiroNetwork\ExperimentalFeatures\feature\interface\IItem;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable;
use NeiroNetwork\ExperimentalFeatures\feature\interface\Smeltable2;
use NeiroNetwork\ExperimentalFeatures\hack\BlameChunkRequestTask;
use NeiroNetwork\ExperimentalFeatures\hack\BlockMappingHack;
use NeiroNetwork\ExperimentalFeatures\hack\ItemTranslatorHack;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalBlocks;
use NeiroNetwork\ExperimentalFeatures\registry\ExperimentalItems;
use pocketmine\block\BlockFactory;
use pocketmine\block\UnknownBlock;
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
			if(!$feature instanceof IBlockOnly){
				// Minecraftの挙動的にはStringToItemParserもここに入れるべきだが、クリエイティブインベントリに追加しないだけにしておく
				CreativeInventory::getInstance()->add(ExperimentalBlocks::fromString($feature->name())->asItem());
			}
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
	public function registerRecipe(Feature $feature) : void{
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

	/**
	 * PocketMine-MPのレシピはネットワークIDが使われている (ブロックはレガシーID使ってるのに)
	 * 見つけたらインターナルIDのレシピを追加する
	 */
	public function remapExistsRecipe(Feature $feature) : void{
		if(!$feature instanceof IItem && !$feature instanceof IBlock) return;

		$craftingManager = Server::getInstance()->getCraftingManager();
		foreach($craftingManager->getShapelessRecipes() as $shapelessRecipes){
			foreach($shapelessRecipes as $shapelessRecipe){
				$recipeModified = false;
				$newInputs = $shapelessRecipe->getIngredientList();
				$newOutputs = $shapelessRecipe->getResults();
				foreach($shapelessRecipe->getIngredientList() as $key => $input){
					if($input->getId() === $feature->networkId()){
						$recipeModified = true;
						$newInputs[$key] = ItemFactory::getInstance()->get($feature->internalId(), $input->getMeta(), $input->getCount(), $input->getNamedTag());
					}
				}
				foreach($shapelessRecipe->getResults() as $key => $output){
					if($output->getId() === $feature->networkId()){
						$recipeModified = true;
						$newOutputs[$key] = ItemFactory::getInstance()->get($feature->internalId(), $output->getMeta(), $output->getCount(), $output->getNamedTag());
					}
				}
				if($recipeModified){
					$craftingManager->registerShapelessRecipe(new ShapelessRecipe($newInputs, $newOutputs));
				}
			}
		}

		foreach($craftingManager->getShapedRecipes() as $shapedRecipes){
			foreach($shapedRecipes as $shapedRecipe){
				$p = (new \ReflectionClass($shapedRecipe))->getProperty("ingredientList");
				$p->setAccessible(true);

				$recipeModified = false;
				$newInputs = $p->getValue($shapedRecipe);
				$newOutputs = $shapedRecipe->getResults();
				foreach($p->getValue($shapedRecipe) as $stringKey => $input){
					if($input->getId() === $feature->networkId()){
						$recipeModified = true;
						$newInputs[$stringKey] = ItemFactory::getInstance()->get($feature->internalId(), $input->getMeta(), $input->getCount(), $input->getNamedTag());
					}
				}
				foreach($shapedRecipe->getResults() as $key => $output){
					if($output->getId() === $feature->networkId()){
						$recipeModified = true;
						$newOutputs[$key] = ItemFactory::getInstance()->get($feature->internalId(), $output->getMeta(), $output->getCount(), $output->getNamedTag());
					}
				}
				if($recipeModified){
					$craftingManager->registerShapedRecipe(new ShapedRecipe($shapedRecipe->getShape(), $newInputs, $newOutputs));
				}
			}
		}
	}

	/**
	 * 追加されてないアイテムをクラフトできるバグを修正する
	 */
	public function fixPmmpRecipes() : void{
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