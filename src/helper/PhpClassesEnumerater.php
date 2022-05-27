<?php

declare(strict_types=1);

namespace NeiroNetwork\ExperimentalFeatures\helper;

use pocketmine\Server;
use Webmozart\PathUtil\Path;

class PhpClassesEnumerater{

	public static function list(string $path, string $classString) : array{
		$namespaces = explode("\\", self::class);
		array_pop($namespaces);

		$plugin = Server::getInstance()->getPluginManager()->getPlugin($namespaces[1] ?? "");
		if($plugin === null){
			throw new \RuntimeException("Parsed an unsupported namespace: " . implode("\\", $namespaces));
		}

		$mainNamespace = explode("\\", $plugin->getDescription()->getMain());
		array_pop($mainNamespace);
		$mainNamespace = implode("\\", $mainNamespace);

		$pluginFile = (new \ReflectionClass($plugin))->getParentClass()->getProperty("file");
		$pluginFile->setAccessible(true);

		$path = Path::join($pluginFile->getValue($plugin), "src", $path);
		$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS));

		$classList = [];

		/** @var \SplFileInfo $file */
		foreach($iterator as $file){
			$class = $mainNamespace . str_replace(["/", ".php"], ["\\", ""], explode("src", $file->getPathname())[1]);
			if(class_exists($class) && is_a($class, $classString, true)){
				$reflection = new \ReflectionClass($class);
				if(!$reflection->isAbstract() && !$reflection->isInterface()){
					$classList[] = $class;
				}
			}
		}

		return $classList;
	}
}