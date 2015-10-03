<?php

namespace Controllers\User;

class Index extends \Controllers\Base {

	public function index() {		
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
		}
		$categories = new \Models\Category();
		$allCategories = $categories->find();
		$products = new \Models\Product();
		$allProducts = $products->find(array('where'=>'quantity > "0"'));
		$data = array();
		$data[] = $allCategories;
		$data[] = $allProducts;
		$this->view->appendToLayout('body', 'index');
		$this->view->display('layouts.default', $data);
	}
}