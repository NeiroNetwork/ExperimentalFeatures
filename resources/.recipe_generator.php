<?php

declare(strict_types=1);

abstract class Recipe{
	protected string $block;
	protected array $input;
	protected array $output;

	abstract public function __construct(array $rawRecipe);

	protected function toItem(array $rawItem) : array{
		$item = ["id" => $rawItem["item"]];
	}
}

abstract class CraftingRecipe extends Recipe{
	protected int $priority;
}

class ShapedRecipe extends CraftingRecipe{
	protected array $shape;

	public function __construct(array $rawRecipe){
	}
}

class ShapelessRecipe extends CraftingRecipe{
	public function __construct(array $rawRecipe){
	}
}

class SmeltingRecipe extends Recipe{
	public function __construct(array $rawRecipe){
	}
}


$iterator = new DirectoryIterator(dirname(__FILE__) . DIRECTORY_SEPARATOR . "recipes");
foreach($iterator as $info){
	/** @var DirectoryIterator $info */
	if($info->isFile()){
		$data = json_decode(file_get_contents($info->getPathname()), true);
		if($data === null){
			continue;
		}
		if(!is_array($data)){
			echo "Invalid recipe file: {$info->getFilename()}" . PHP_EOL;
			continue;
		}
		foreach($data as $key => $value){
			match ($key) {
				"format_version" => null,
				"minecraft:recipe_shaped" => shapedRecipe($value),
				"minecraft:recipe_shapeless" => /*craftingRecipe("shapeless", $value)*/
				3,
				"minecraft:recipe_furnace" => /*shapedRecipe($value)*/
				2,
				default => print "Unknown key found: \"{$key}\"" . PHP_EOL,
			};
		}
	}
}

