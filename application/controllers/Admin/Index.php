<?php

namespace Controllers\Admin;

class Index extends \Controllers\Base {
	
	public function index()	{
		if(!isset($_SESSION['userId']) || $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$userDb = new \Models\User();
		$allUsers = $userDb->find();

		$this->view->appendToLayout('body', 'adminIndex');
		$this->view->display('layouts.default', $allUsers);
	}
}