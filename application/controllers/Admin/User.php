<?php

namespace Controllers\Admin;

class User extends \Controllers\Base {
	
	public function edit() {
		if(!isset($_SESSION['userId']) || $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$userDb = new \Models\User();
		$user_id = $this->input->get(0);

		if (isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password'])|| isset($_POST['type'])|| isset($_POST['banned'])) {
			$updateUser = array();

			$cleaner = new \Framework\Common();

			if (isset($_POST['username'])) {
				$username = $cleaner->normalize($_POST['username'], 'trim|xss|string');
				$updateUser['username'] = $username;
			}

			if (isset($_POST['email'])) {
				$email = $cleaner->normalize($_POST['email'], 'trim|xss|string');
				$updateUser['email'] = $desciption;
			}

			if (isset($_POST['password'])) {
				$password = $cleaner->normalize($_POST['password'], 'trim|xss|string');
				$updateUser['password'] = $password;
			}

			if (isset($_POST['type'])) {
				$type = $cleaner->normalize($_POST['quantity'], 'trim|xss|string');
				if ($type == 'user' || $type == 'editor' || $type == 'admin') {
					$updateUser['type'] = $type;
				}
			}

			if (isset($_POST['banned'])) {
				$banned = $cleaner->normalize($_POST['banned'], 'trim|xss|int');
				$updateUser['banned'] = $banned;
			}

			$updateUser['user_id'] = $user_id;

			$userDb->update('user', $updateUser);
			header('Location: /php_project/application/public/admin/index');
			exit;
		}

		$user = $userDb->get('user_id='.$user_id)[0];

		if (!is_numeric($user_id) || !$user) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->view->appendToLayout('body', 'editUser');
		$this->view->display('layouts.default', $user);
	}

	public function ban() {
		if(!isset($_SESSION['userId']) || $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$user_id = $this->input->get(0);
		$userDb = new \Models\User();
		$user = $userDb->get('user_id = '.$user_id);

		if (!is_numeric($user_id) || !$user) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$userUpdate = array();
		$userUpdate['banned'] = 1;
		$userUpdate['user_id'] = $user_id;

		$userDb->update('user', $userUpdate);
		header('Location: /php_project/application/public/admin/index');
		exit;
	}
}