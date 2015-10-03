<?php

namespace Controllers;

class Products extends \Controllers\Base {

	public function category() {
		$category_id = $this->input->get(0);
		$productDb = new \Models\Product();
		$products = $productDb->getByCategory($category_id);
		$categories = new \Models\Category();
		$allCategories = $categories->find();
		$data = array();
		$data[] = $allCategories;
		$data[] = $products;
		$this->view->appendToLayout('body', 'index');
		$this->view->display('layouts.default', $data);
	}
}