<?php

namespace Framework\Routers;

class DefaultRouter implements \Framework\Routers\IRouter {

	public function getUri() {
		return substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME'])+1);
	}

}