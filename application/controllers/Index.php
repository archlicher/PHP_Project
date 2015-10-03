<?php

namespace Controllers;

class Index extends \Controllers\Base {

	public function index() {
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