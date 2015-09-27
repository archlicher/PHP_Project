<?php

namespace Framework;

include_once 'Loader.php';

class App {

	private static $instance = null;
	private $config = null;
	private $frontController = null;

	private function __construct() {
		\Framework\Loader::registerNamespace('Framework', dirname(__FILE__).DIRECTORY_SEPARATOR);
		\Framework\Loader::registerAutoLoad();
		$this->config = \Framework\Config::getInstance();
		if ($this->config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
	}

	public function setConfigFolder($path) {
		$this->config->setConfigFolder($path);
	}

	public function getConfigFolder() {
		return $this->configFolder;
	}
	/**
	 * 
	 * @return \Framework\Config
	 */
	public function getConfig() {
		return $this->config;
	}

	public function run() {
		if ($this->config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}

		$this->frontController = \Framework\FrontController::getInstance();
		$this->frontController->dispatch();
	}

	/**
	 * 
	 * @return \Framework\App
	 */
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new \Framework\App();
		}

		return self::$instance;
	}
}