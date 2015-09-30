<?php

namespace Framework;

class View {

	private static $instance = null;
	private $___viewPath = null;
	private $___viewDir = null;
	private $___extension = '.php';
	private $___layoutParts = array();
	private $___layoutData = array();
	private $___data = array();

	private function __construct() {
		$this->___viewPath = \Framework\App::getInstance()->getConfig()->app['viewDirectory'];
		if ($this->___viewPath == null) {
			$this->___viewPath = realpath('../views/');
		}
	}

	public function appendToLayout($key, $template) {
		if ($key && $template) {
			$this->___layoutParts[$key] = $template;
		} else {
			throw new \Exception("Invalid key ".$key." and template ".$template, 500);
		}
	}

	public function setViewDirectory($path) {
		$path = trim($path);
		if ($path) {
			$path = realpath($path).DIRECTORY_SEPARATOR;
			if (is_dir($path) && is_readable($path)) {
				$this->___viewDir = $path;
			} else {
				throw new \Exception("No view path", 500);
			}
		} else {
			throw new \Exception("No view path", 500);
		}
	}

	public function display($name, $data = array(), $returnAsString = false) {
		if (is_array($data)) {
			$this->___data = array_merge($this->___data, $data);
		}

		if (count($this->___layoutParts)>0) {
			foreach ($this->___layoutParts as $key => $value) {
				$r = $this->includeFile($value);
				if ($r) {
					$this->___layoutData[$key] = $r;
				}
			}
		}

		if ($returnAsString) {
			return $this->includeFile($name);
		} else {
			echo $this->includeFile($name);
		}
	}

	public function getLayoutData($name) {
		return $this->___layoutData[$name];
	}

	private function includeFile($file) {
		if ($this->___viewDir == null) {
			$this->setViewDirectory($this->___viewPath);
		}
		$___fl = $this->___viewDir.str_replace('.', DIRECTORY_SEPARATOR, $file).$this->___extension;
		if (file_exists($___fl) && is_readable($___fl)) {
			ob_start();
			include $___fl;
			return ob_get_clean();
		} else {
			throw new \Exception("View" . $file . "cannot be included", 500);
		}
	}

	public function __get($name) {
		return $this->___data[$name];
	}

	public function __set($name, $value) {
		$this->___data[$name] = $value;
	}

	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new \Framework\View();
		}

		return self::$instance;
	}
}