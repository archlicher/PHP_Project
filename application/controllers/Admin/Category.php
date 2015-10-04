<?php

namespace Controllers\Editor;

class Category extends \Controllers\Base {

	public function edit() {
		if(!isset($_SESSION['userId']) && $_SESSION['editor']!=true &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		
		$category_id = $this->input->get(0);
		$categoryDb = new \Models\Category();
		$category = $categoryDb->get('category_id = '.$category_id)[0];

		if (isset($_POST['name'])) {
			$cleaner = new \Framework\Common();
			$name = $cleaner->normalize($_POST['name'], 'trim|xss|string');
			if ($name == $category['name']) {
				header('Location: /php_project/application/public/editor/index');
				exit;
			}

			$updateCategory = array();
			$updateCategory['name'] = $name;
			$updateCategory['category_id'] = $category_id;

			$categoryDb->update('category', $updateCategory);

			header('Location: /php_project/application/public/editor/index');
			exit;
		}

		if (!is_numeric($category_id) || !$category) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->view->appendToLayout('body', 'editCategory');
		$this->view->display('layouts.default', $category);
	}
}