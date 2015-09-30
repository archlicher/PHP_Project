<?php

namespace Framework\Routers;

class JsonRpcRouter implements \Framework\Routers\IRouter {

	private $map = array();
	private $requestId;
	private $post = array();

	public function __construct() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SERVER['CONTENT_TYPE']) || $_SERVER['CONTENT_TYPE'] != 'application/json') {
			throw new \Exception("Require json request", 400);
		}
	}

	public function setMethodsMap($ar) {
		if (is_array($ar)) {
			$this->map = $ar;
		}
	}

	public function getUri() {
		if (!is_array($this->map) || count($this->map) == 0) {
			$ar = \Framework\App::getInstance()->getConfig()->rpcRoutes;
			if (is_array($ar) && count($ar) > 0) {
				$this->map = $ar;
			} else {
				throw new \Exception("Router require method map", 500);
			}
		}

		$request = json_decode(file_get_contents('php://input', true));
		if (!is_array($request) || !isset($request['method'])) {
			throw new \Exception("Require json request", 400);
		} else {
			if ($this->map[$request['method']]) {
				$this->requestId = $request['id'];
				$this->post = $request['params'];
				return $this->map[$request[$method]];				
			}
			throw new \Exception("Require json request", 501);
		}
	}

	public function getPost() {
		return $this->post;
	}

	public function getRequestId() {
		return $this->requestId;
	}
}