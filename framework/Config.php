<?php

namespace Framework;

class Config {

	private static $instance = null;

	private $configArray = array();
	private $configFolder = null;

	private function __construct() {

	}

	public function getConfigFolder() {
		return $this->configFolder;
	}

	public function setConfigFolder($configFolder) {
		if (!$configFolder) {
			throw new \Exception("Empty config folder path.");
		}
		$realConfFolder = realpath($configFolder);
		if ($realConfFolder != FALSE && is_dir($realConfFolder) && is_readable($realConfFolder)) {
			$this->configArray = array();
			$this->configFolder = $realConfFolder.DIRECTORY_SEPARATOR;
			$ns = $this->app['namespaces'];
			if (is_array($ns)) {
				\Framework\Loader::registerNamespaces($ns);
			}
		} else {
			throw new \Exception("Error Processing Request");
		}
	}

	public function __get($name) {
		if(!$this->configArray[$name]) {
			$this->includeConfigFile($this->configFolder.$name.'.php');
		}
		if(array_key_exists($name, $this->configArray)) {
			return $this->configArray[$name];
		}
		return null;
	}

	/**
	 * 
	 * @return \Framework\Config
	 */
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new \Framework\Config();
		}

		return self::$instance;
	}

	private function includeConfigFile($path) {
		if(!$path) {
			throw new \Exception("No path");
		}
		$file = realpath($path);
		if ($file != FALSE && is_file($file) && is_readable($file)) {
			$basename = explode('.php', basename($file))[0];
			$this->configArray[$basename] = include $file;
		} else {
			throw new \Exception("Confif file read error: ".$path);
		}
	}
}