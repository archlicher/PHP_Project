<?php

namespace Controllers\User;

class Auth extends \Controllers\Base {

	public function login() {

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cleaner = new \Framework\Common();
			$username = $cleaner->normalize($username, 'trim|xss|string');
			$password = $cleaner->normalize($password, 'trim|xss|string');

			$userDb = new \Models\User();
			$user = $userDb->getUser($username)[0];

			if (!$user || $user['password'] != $password || $user['banned'] == 1) {
				header('Location: /php_project/application/public/');
				exit;
			}

			$_SESSION['userId'] = $user['user_id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION[$user['type']] = true;
			
			header('Location: /php_project/application/public/user/index');
		}

		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.default');
	}

	public function register() {
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['email'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cPassword = $_POST['confirmPassword'];
			$email = $_POST['email'];
			if ($password != $cPassword) {
				header('Location: /php_project/application/public/');
			}

			$cleaner = new \Framework\Common();
			$newUser['username'] = $cleaner->normalize($username, 'trim|xss|string');
			$newUser['password'] = $cleaner->normalize($password, 'trim|xss|string');
			$newUser['email'] = $cleaner->normalize($email, 'trim|xss|string');
			
			$userDb = new \Models\User();
			$user = $userDb->add($newUser);
			if (!is_numeric($user)) {
				header('Location: /php_project/application/public/');
				exit;
			} else {
				$this->loginAfterRegister($user, $newUser['username']);
			}
		}

		$this->view->appendToLayout('body', 'register');
		$this->view->display('layouts.default');
	}

	private function loginAfterRegister($id, $username) {
		$_SESSION['userId'] = $id;
		$_SESSION['username'] = $username;
		$_SESSION['user'] = true;
		
		header('Location: /php_project/application/public/user/index');
	}

	public function logout() {
		session_destroy();
		header('Location: /php_project/application/public/');
	}
}