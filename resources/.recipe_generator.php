<?php

declare(strict_types=1);

set_error_handler(fn(int $severity, string $message, string $file, int $line) => throw new ErrorException($message, 0, $severity, $file, $line));

function message(string $prefix, string $message) : void{
	$prefix = strtoupper($prefix);
	echo "[$prefix] $message" . PHP_EOL;
}

abstract class Recipe implements JsonSerializable{
	protected string $block;
	protected array $input = [];
	protected array $output = [];

	abstract protected function __construct(array $rawRecipe, string $block);

	public static function from(array $rawRecipe) : array{
		return array_map(fn($block) => new static($rawRecipe, $block), $rawRecipe["tags"]);
	}

	protected function toItem(array $rawItem) : array{
		$item = ["id" => $rawItem["item"]];
		if(!empty($rawItem["data"])){
			$item["damage"] = $rawItem["data"];
		}
		if(isset($rawItem["count"]) && $rawItem["count"] > 1){
			$item["count"] = $rawItem["count"];
		}
		// TODO: NBTは確認できていない
		return $item;
	}

	public function jsonSerialize() : array{
		return [
			"block" => $this->block,
			"input" => $this->input,
			"output" => $this->output
		];
	}
}

class CraftingRecipe extends Recipe{
	protected int $priority;

	protected function __construct(array $rawRecipe, string $block){
		$this->block = $block;
		foreach($rawRecipe["key"] ?? $rawRecipe["ingredients"] as $keyString => $itemArray){
			$this->input[$keyString] = $this->toItem($itemArray);
		}
		$this->output = isset($rawRecipe["result"]["item"]) ? [$this->toItem($rawRecipe["result"])] : array_map([$this, "toItem"], $rawRecipe["result"]);
		if(!isset($rawRecipe["priority"])){
			message("debug", "Couldn't find \"priority\" at \"{$rawRecipe["description"]["identifier"]}\", set \"priority\" to 0");
		}
		$this->priority = $rawRecipe["priority"] ?? 0;
	}

	public function jsonSerialize() : array{
		return [
			"block" => $this->block,
			"input" => $this->input,
			"output" => $this->output,
			"priority" => $this->priority
		];
	}
}

class ShapedRecipe extends CraftingRecipe{
	protected array $shape = [];

	protected function __construct(array $rawRecipe, string $block){
		parent::__construct($rawRecipe, $block);
		$this->shape = $rawRecipe["pattern"];
	}

	public function jsonSerialize() : array{
		return [
			"block" => $this->block,
			"input" => $this->input,
			"output" => $this->output,
			"priority" => $this->priority,
			"shape" => $this->shape
		];
	}
}

class SmeltingRecipe extends Recipe{
	protected function __construct(array $rawRecipe, string $block){
		$this->block = $block;
		$this->input = $this->toItem(is_array($rawRecipe["input"]) ? $rawRecipe["input"] : ["item" => $rawRecipe["input"]]);
		$this->output = $this->toItem(is_array($rawRecipe["output"]) ? $rawRecipe["output"] : ["item" => $rawRecipe["output"]]);
	}
}

/** @var ShapedRecipe[] $shapedRecipes */
$shapedRecipes = [];
/** @var CraftingRecipe[] $shapelessRecipes */
$shapelessRecipes = [];
/** @var SmeltingRecipe[] $smeltingRecipes */
$smeltingRecipes = [];

$iterator = new DirectoryIterator(dirname(__FILE__) . DIRECTORY_SEPARATOR . "recipes");
foreach($iterator as $info){
	/** @var DirectoryIterator $info */
	if($info->isFile()){
		$data = json_decode(file_get_contents($info->getPathname()), true);
		if($data === null){
			continue;
		}
		if(!is_array($data)){
			message("warning", "\"{$info->getFilename()}\" is invalid recipe file");
			continue;
		}
		foreach($data as $key => $value){
			match ($key) {
				"format_version" => null,
				"minecraft:recipe_shaped" => $shapedRecipes = array_merge($shapedRecipes, ShapedRecipe::from($value)),
				"minecraft:recipe_shapeless" => $shapelessRecipes = array_merge($shapelessRecipes, CraftingRecipe::from($value)),
				"minecraft:recipe_furnace" => $smeltingRecipes = array_merge($smeltingRecipes, SmeltingRecipe::from($value)),
				default => message("notice", "Unknown key \"$key\" was found"),
			};
		}
	}
}

file_put_contents("recipes.json", json_encode([
	"shaped" => $shapedRecipes,
	"shapeless" => $shapelessRecipes,
	"smelting" => $smeltingRecipes,
]));
message("info", "Exported file as \"recipes.json\"");