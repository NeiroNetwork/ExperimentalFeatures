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

		$file = (new \ReflectionClass($plugin))->getParentClass()->getProperty("file");
		$file->setAccessible(true);
		$file = $file->getValue($plugin);

		$mainNamespace = explode("\\", $plugin->getDescription()->getMain());
		array_pop($mainNamespace);

		$path = Path::join(Path::join($file, "src", ...$mainNamespace), $path);
		$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS));

		$classList = [];

		foreach($iterator as $file){
			/** @var \SplFileInfo $file */
			$class = str_replace(["/", ".php"], ["\\", ""], explode("src", $file->getPathname())[1]);
			if(class_exists($class) && is_a($class, $classString, true) && !(new \ReflectionClass($class))->isAbstract()){
				$classList[] = $class;
			}
		}

		return $classList;
	}
}