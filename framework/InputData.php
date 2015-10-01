<?php

namespace Framework;

class InputData {

	private static $instance;
	private $get = array();
	private $post = array();
	private $cookies = array();

	private function __construct() {
		$this->cookies = $_COOKIE;
	}

	public function setPost($array) {
		if (is_array($array)) {
			$this->post = $array;			
		}
	}

	public function setGet($array) {
		if (is_array($array)) {
			$this->get = $array;
		}
	}

	public function hasGet($id) {
		return array_key_exists($id, $this->get);
	}

	public function hasPost($name) {
		return array_key_exists($name, $this->post);
	}

	public function hasCookies($name) {
		return array_key_exists($name, $this->cookies);
	}

	public function get($id, $normalize=null, $default=null) {
		if ($this->hasGet($id)) {
			if ($normalize != null) {
				return \Framework\Common::normalize($this->get[$id], $normalize);
			}
			return $this->get[$id];
		}

		return $default;
	}

	public function post($name, $normalize=null, $default=null) {
		if ($this->hasPost($name)) {
			if ($normalize != null) {
				return \Framework\Common::normalize($this->post[$name], $normalize);
			}
			return $this->post[$name];
		}

		return $default;
	}

	public function cookies($name, $normalize=null, $default=null) {
		if ($this->hasCookies($name)) {
			if ($normalize != null) {
				return \Framework\Common::normalize($this->cookies[$name], $normalize);
			}
			return $this->cookies[$name];
		}

		return $default;
	}

	/**
	*@return \AR\InputData
	*/
	public static function getInstance(){
		if (self::$instance==null) {
			self::$instance = new \Framework\InputData();
		}

		return self::$instance;
	}
}