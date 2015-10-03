<?php

namespace Framework\Routers;

class DefaultRouter implements \Framework\Routers\IRouter {

	public function getUri() {

		$home = substr($_SERVER['SCRIPT_NAME'],0,strlen($_SERVER['SCRIPT_NAME'])-9);
		return substr($_SERVER['REQUEST_URI'] , strlen($home),strlen($_SERVER['REQUEST_URI'])-strlen($home));

		#return substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME'])+1);
	}

	public function getPost() {
		return $_POST;
	}

}