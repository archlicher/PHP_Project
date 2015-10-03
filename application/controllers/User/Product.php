<?php

namespace Controllers\User;

class Profile extends \Controllers\Base {

	private $user = null;

	public function buy() {
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
		}
	}

	public function sell() {
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
		}
	}

	private function getUser() {
		$userDb = new \Models\User();
		$this->user = $userDb->get('user_id = '.$_SESSION['userId']);
	}
}