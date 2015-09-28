<?php

namespace Framework;

include_once 'Loader.php';

class App {

	private static $instance = null;
	private $config = null;
	private $frontController = null;
	private $router = null;
	private $dbConnections = array();

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

	public function getRouter() {
		return $this->router;
	}

	public function setRouter($router) {
		$this->router = $router;
	}

	public function run() {
		if ($this->config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}

		$this->frontController = \Framework\FrontController::getInstance();
		if ($this->router instanceof \Framework\Routers\IRouter) {
			$this->frontController->setRouter($this->router);
		} else if ($this->router == 'JsonRPCRouter') {
			$this->frontController->setRouter(new \Framework\Routers\DefaultRouter());
		} else if ($this->router == 'CLIRouter') {
			$this->frontController->setRouter(new \Framework\Routers\DefaultRouter());
		} else {
			$this->frontController->setRouter(new \Framework\Routers\DefaultRouter());
		}
		$this->frontController->dispatch();
	}

	public function getDBConnection($connection = 'default') {
		if (!$connection) {
			throw new \Exception("No connection identifier provided", 500);
		}
		if ($this->dbConnections[$connection]) {
			return $this->dbConnections[$connection];
		}
		$cnf = $this->getConfig()->database;
		if (!$cnf[$connection]) {
			throw new \Exception("Invalid connection identifier", 500);
		}
		$dbh = new \PDO($cnf[$connection]['connection_uri'], $cnf[$connection]['username'], $cnf[$connection]['password'], $cnf[$connection]['pdo_options']);

		$this->dbConnections[$connection] = $dbh;
		return $dbh;
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