<?php

namespace Framework;

final class Loader {

	private static $namespaces = array();

	private function __construct() {

	}

	public static function registerAutoLoad() {
		spl_autoload_register(array("\Framework\Loader", 'autoload'));
	}

	public static function autoload($class) {
		self::loadClass($class);
	}

	public static function loadClass($class) {
		foreach (self::$namespaces as $key => $value) {
			if (strpos($class, $key) === 0) {
				$file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
				$file = substr_replace($file, $value, 0, strlen($key)).'.php';
				$file = realpath($file);
				if ($file != FALSE && is_readable($file)) {
					include $file;
				} else {
					throw new \Exception("File cannot be included: ".$file);
				}
				break;
			}
		}
	}

	public static function registerNamespace($namespace, $path) {
		$namespace = trim($namespace);
		if (strlen($namespace)>0) {
			if (!$path) {
				throw new \Exception("Invalid path");
			}
			$rPath = realpath($path);
			if ($rPath != FALSE && is_dir($rPath) && is_readable($rPath)) {
				self::$namespaces[$namespace.'\\'] = $rPath . DIRECTORY_SEPARATOR;
			} else {
				throw new \Exception("Namespace directory read error: " . $path);
			}
		} else {
			throw new \Exception("Invalid namespace: ".$namespace);
		}
	}

	public static function getNamespaces() {
		return self::$namespaces;
	}

	public static function removeNamespace($namespace) {
		unset(self::$namespaces[$namespace]);
	}

	public static function clearNamespaces() {
		self::$namespaces = array();
	}
}