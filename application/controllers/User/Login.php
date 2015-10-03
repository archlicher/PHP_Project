<?php

namespace Controllers\User;

class Login extends \Controllers\Base {

	public function login() {

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cleaner = new \Framework\Common();
			$username = $cleaner->normalize($username, 'xss|string');
			$password = $cleaner->normalize($password, 'xss|string');

			$userDb = new \Models\User();
			$user = $userDb->getUser($username)[0];
			if (!$user || $user['password'] != $password) {
				header('Location: /php_project/application/public/');
			}

			$_SESSION['userId'] = $user['user_id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION[$user['type']] = true;
			
			if ($user['type'] == 'admin') {

				header('Location: /php_project/application/public/admin/index');
			} else if ($user['type'] == 'editor') {
				header('Location: /php_project/application/public/editor/index');
			} else {
				header('Location: /php_project/application/public/user/index');
			}
		}

		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.default');
	}

	public function register() {


		$this->view->appendToLayout('body', 'register');
		$this->view->display('layouts.default');
	}

	public function logout() {
		session_destroy();
		header('Location: /php_project/application/public/');
	}
}