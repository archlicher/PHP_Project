<?php

namespace Framework;

class FrontController {

	private static $instance;
	private $ns = null;
	private $controller = null;
	private $method = null;
	private $params = array();
	private $router = null;

	private function __construct() {

	}

	public function getRouter() {
		return $this->router;
	}

	public function setRouter(\Framework\Routers\IRouter $router) {
		$this->router = $router;
	}

	public function dispatch() {
		$router = new \Framework\Routers\DefaultRouter();
		if ($this->router == null) {
			throw new \Exception("No valid router found", 500);
		}
		$uri = $this->router->getUri();
		$routes = \Framework\App::getInstance()->getConfig()->routes;
		$rc = null;
		if (is_array($routes) && count($routes)>0) {
			foreach ($routes as $key => $value) {
				if (stripos($uri, $key) === 0 && ($uri==$key || stripos($uri, $key.'/')===0) && $value['namespace']) {
					$this->ns = $value['namespace'];
					$uri = substr($uri, strlen($key)+1);
					$rc = $value;
					break;
				}
			}
		} else {
			throw new \Exception("No routes.", 500);
		}

		if ($this->ns == null && $routes['*']['namespace']) {
			$this->ns = $routes['*']['namespace'];
			$rc = $routes['*'];
		} else if ($this->ns == null && !$routes['*']['namespace']) {
			throw new \Exception("Default routes missing", 500);
		}

		$input = \Framework\InputData::getInstance();
		$params = explode('/', $uri);
		if ($params[0]) {
			$this->controller = strtolower($params[0]);
			if ($params[1]) {
				$this->method = strtolower($params[1]);
				unset($params[0], $params[1]);
				$input->setGet(array_values($params));
			} else {
				$this->method = $this->getDefaultMethod();
			}
		} else {
			$this->controller = $this->getDefaultController();
			$this->method = $this->getDefaultMethod();
		}
		if (is_array($rc) && $rc['controllers']) {
			if ($rc['controllers'][$this->controller]['methods'][$this->method]) {
				$this->method = strtolower($rc['controllers'][$this->controller]['methods'][$this->method]);
			}
			if (isset($rc['controllers'][$this->controller]['to'])) {
				$this->controller=strtolower($rc['controllers'][$this->controller]['to']);
			}
		}
		$input->setPost($this->router->getPost());

		$controllerClass = $this->ns.'\\'.ucfirst($this->controller);
		$newController = new $controllerClass();
		$newController->{$this->method}();
	}

	public function getDefaultController() {
		$controller = \Framework\App::getInstance()->getConfig()->app['default_controller'];
		if ($controller) {
			return strtolower($controller);
		}
		return 'index';
	}

	public function getDefaultMethod() {
		$method = \Framework\App::getInstance()->getConfig()->app['default_method'];
		if ($method) {
			return strtolower($method);
		}
		return 'index';
	}

	public static function getInstance() {
		if (self::$instance==null) {
			self::$instance =  new \Framework\FrontController();
		}

		return self::$instance;
	}
}