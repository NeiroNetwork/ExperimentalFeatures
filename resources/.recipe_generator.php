<?php

declare(strict_types=1);

set_error_handler(fn(int $severity, string $message, string $file, int $line) => throw new ErrorException($message, 0, $severity, $file, $line));

function message(string $type, string $message) : void{
	$type = strtoupper($type);
	echo "[$type] $message" . PHP_EOL;
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

abstract class CraftingRecipe extends Recipe{
	protected int $priority;

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

	public function __construct(array $rawRecipe, string $block){
		$this->block = $block;
		foreach($rawRecipe["key"] as $keyString => $itemArray){
			$this->input[$keyString] = $this->toItem($itemArray);
		}
		$this->output = isset($rawRecipe["result"]["item"]) ? [$this->toItem($rawRecipe["result"])] : array_map([$this, "toItem"], $rawRecipe["result"]);	#BlameMojang
		if(!isset($rawRecipe["priority"])){
			message("debug", "Couldn't find \"priority\" at \"{$rawRecipe["description"]["identifier"]}\", set \"priority\" to 0");
		}
		$this->priority = $rawRecipe["priority"] ?? 0;
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

class ShapelessRecipe extends CraftingRecipe{
	public function __construct(array $rawRecipe, string $block){
		$this->block = $block;
		foreach($rawRecipe["key"] as $keyString => $itemArray){
			$this->input[$keyString] = $this->toItem($itemArray);
		}
		$this->output = isset($rawRecipe["result"]["item"]) ? [$this->toItem($rawRecipe["result"])] : array_map([$this, "toItem"], $rawRecipe["result"]);	#BlameMojang
		if(!isset($rawRecipe["priority"])){
			message("debug", "Couldn't find \"priority\" at \"{$rawRecipe["description"]["identifier"]}\", set \"priority\" to 0");
		}
		$this->priority = $rawRecipe["priority"] ?? 0;
	}
}

class SmeltingRecipe extends Recipe{
	public function __construct(array $rawRecipe, string $block){
	}
}

$shapedRecipes = [];
$shapelessRecipes = [];
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
				"minecraft:recipe_shaped" => array_push($shapedRecipes, ShapedRecipe::from($value)),
				"minecraft:recipe_shapeless" => array_push($shapelessRecipes, ShapelessRecipe::from($value)),
				"minecraft:recipe_furnace" => null,	//TODO
				default => message("notice", "Unknown key \"$key\" was found"),
			};
		}
	}
}