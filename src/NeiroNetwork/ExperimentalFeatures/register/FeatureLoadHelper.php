<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\register;

use NeiroNetwork\ExperimentalFeatures\feature\Feature;
use pocketmine\Server;
use Webmozart\PathUtil\Path;

final class FeatureLoadHelper{

	/** @var Feature[] $featureCache */
	private static array $featureCache;

	public static function getList() : array{
		if(!isset(self::$featureCache)){
			self::$featureCache = [];
			self::load();
		}
		return self::$featureCache;
	}

	private static function load() : void{
		$plugin = Server::getInstance()->getPluginManager()->getPlugin("ExperimentalFeatures");
		$file = (new \ReflectionClass($plugin))->getParentClass()->getProperty("file");
		$file->setAccessible(true);
		$file = $file->getValue($plugin);

		$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(
			Path::join($file, "src/NeiroNetwork/ExperimentalFeatures/feature"),
			\FilesystemIterator::SKIP_DOTS));
		foreach($iterator as $file){
			/** @var \SplFileInfo $file */
			$class = str_replace(["/", ".php"], ["\\", ""], explode("src", $file->getPathname())[1]);
			if(class_exists($class) && is_a($class, Feature::class, true) && !(new \ReflectionClass($class))->isAbstract()){
				self::$featureCache[] = new $class();
			}
		}
	}
}