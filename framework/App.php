<?php

namespace Framework;

include_once 'Loader.php';

class App {

	private static $instance = null;
	private $config = null;
	private $frontController = null;
	private $router = null;
	private $dbConnections = array();
	private $session = null;

	private function __construct() {
		set_exception_handler(array($this, 'exceptionHandler'));
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
		} else if ($this->router == 'JsonRpcRouter') {
			$this->frontController->setRouter(new \Framework\Routers\JsonRpcRouter());
		} else {
			$this->frontController->setRouter(new \Framework\Routers\DefaultRouter());
		}

		$sess = $this->config->app['session'];
		if ($sess['autostart']) {
			if ($sess['type'] == 'native') {
				$s = new \Framework\Session\NativeSession($sess['name'], $sess['lifetime'], $sess['path'], $sess['domain'], $sess['secure']);
			} else if ($sess['type'] = 'database') {
				$s = new \Framework\Session\NativeSession($sess['dbConnection'], $sess['name'], $sess['dbTable'], $sess['lifetime'], $sess['path'], $sess['domain'], $sess['secure']); 
			} else {
				throw new \Exception("No valid session", 500);
			}
			$this->setSession($s);
		}

		$this->frontController->dispatch();
	}

	/**
	 * 
	 * @return \Framework\Session\ISession
	 */
	public function getSession() {
		return $this->session;
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

	public function exceptionHandler(\Exception $ex) {
		if ($this->config && $this->config->app['displayExceptions'] == true) {
			echo '<pre>' . print_r($ex, true). '</pre>';
		} else {
			$this->displayError($ex->getCode());
		}
	}

	public function displayError($code) {
		try {
			$view = \Framework\View::getInstance();
			$view->display('errors.' . $code);
		} catch (\Exception $exc) {
			\Framework\Common::headerStatus($code);
			echo '<h1>' . $error . '</h1>';
			exit;
		}
	}

	public function __destruct() {
		if ($this->session!=null) {
			$this->session->saveSession();
		}
	}
}