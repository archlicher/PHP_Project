<?php

namespace Controllers\Editor;

class Index extends \Framework\DefaultController {
	
	public function index()	{
		if(!isset($_SESSION['userId']) || $_SESSION['editor']!=true) {
			header('Location: /php_project/application/public/');
		}
	}
}