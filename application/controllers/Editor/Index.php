<?php

namespace Controllers\Editor;

class Index extends \Controllers\Base {
	
	public function index()	{
		if(!isset($_SESSION['userId']) || $_SESSION['editor']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$categories = new \Models\Category();
		$allCategories = $categories->find();
		$products = new \Models\Product();
		$allProducts = $products->find();
		$data = array();
		$data[] = $allCategories;
		$data[] = $allProducts;
		$this->view->appendToLayout('body', 'editorIndex');
		$this->view->display('layouts.default', $data);
	}
}