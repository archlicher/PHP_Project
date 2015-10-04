<?php

namespace Controllers\Editor;

class Category extends \Controllers\Base {

	public function remove() {
		if(!isset($_SESSION['userId']) &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		
		$categoryDb = new \Models\Category();
		$category_id = $this->input->get(0);

		$category = $categoryDb->get('category_id='.$category_id)[0];

		if (!is_numeric($category_id) || !$category) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$updateCategory = array();
		$updateCategory['category_id'] = $category_id;
		$updateCategory['deleted'] = true;

		$categoryDb->update('category', $updateCategory);

		header('Location: /php_project/application/public/editor/index');
		exit;
	}

	public function add() {
		if(!isset($_SESSION['userId']) && $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if (isset($_POST['name'])) {
			$cleaner = new \Framework\Common();
			$newCat = array();
			$newCat['name'] = $cleaner->normalize($_POST['name'], 'trim|xss|string');
			$newCat['user_id'] = $_SESSION['userId'];

			$categoryDb = new \Models\Category();
			$categoryDb->add($newCat);

			header('Location: /php_project/application/public/editor/index');
			exit;
		}

		$this->view->appendToLayout('body', 'addPromotion');
		$this->view->display('layouts.default');
	}
}