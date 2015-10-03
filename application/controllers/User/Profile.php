<?php

namespace Controllers\User;

class Profile extends \Controllers\Base {

	private $user = null;

	public function index()	{
		if(!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->getUser();

		$productDb = new \Models\Product();
		$userProducts = $productDb->getProductsByBuyer($_SESSION['userId']);

		$data = array();
		$data[] = $this->user;
		$data[] = $userProducts;

		$this->view->appendToLayout('body', 'profile');
		$this->view->display('layouts.default', $data);
	}

	public function edit() {
		if(!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if ($this->user==null) {
			$this->getUser();
		}

		if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['email'])) {
			$password = $_POST['password'];
			$cPassword = $_POST['confirmPassword'];
			$email = $_POST['email'];
			if ($password != $cPassword) {
				header('Location: /php_project/application/public/user/profile');
				exit;
			}

			$cleaner = new \Framework\Common();
			$editUser['password'] = $cleaner->normalize($password, 'trim|xss|string');
			$editUser['email'] = $cleaner->normalize($email, 'trim|xss|string');
			$editUser['user_id'] = $_SESSION['userId'];

			$userDb = new \Models\User();
			$userDb->update('user', $editUser);

			header('Location: /php_project/application/public/user/profile');
		}

		$this->view->appendToLayout('body', 'editProfile');
		$this->view->display('layouts.default', $this->user);		
	}

	public function cash() {
		if(!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if ($this->user==null) {
			$this->getUser();
		}

		if (isset($_POST['cash']) && isset($_POST['password'])) {
			$cash = $_POST['cash'];
			$password = $_POST['password'];

			$cleaner = new \Framework\Common();
			$password = $cleaner->normalize($password, 'trim|xss|string');
			$editUser['cash'] = $cleaner->normalize($cash, 'trim|xss|double');
			$editUser['user_id'] = $_SESSION['userId'];
			
			if ($this->user[0]['password'] != $password) {
				header('Location: /php_project/application/public/user/profile');
			} else {
				$cash = $cleaner->normalize($this->user[0]['cash'], 'float');
				$editUser['cash'] += $cash;
				$userDb = new \Models\User();
				$userDb->update('user', $editUser);
			}

			header('Location: /php_project/application/public/user/profile');
		}

		$this->view->appendToLayout('body', 'cash');
		$this->view->display('layouts.default', $this->user);		
	}

	private function getUser() {
		$userDb = new \Models\User();
		$this->user = $userDb->get('user_id = '.$_SESSION['userId']);
	}
}