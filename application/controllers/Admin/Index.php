<?php

namespace Controllers\Admin;

class Index extends \Framework\DefaultController {
	
	public function index()	{
		if(!isset($_SESSION['userId']) || $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
		}
	}
}