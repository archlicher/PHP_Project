<?php

namespace Framework;

class FrontController {
	private static $instance;

	private function __construct() {

	}

	public function dispatch() {

	}

	public static function getInstance() {
		if (self::$instance==null) {
			self::$instance =  new \Framework\FrontController();
		}

		return self::$instance;
	}
}