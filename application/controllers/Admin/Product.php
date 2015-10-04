<?php

namespace Controllers\Editor;

class Product extends \Controllers\Base {

	public function remove() {
		if(!isset($_SESSION['userId']) &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		
		$productDb = new \Models\Product();
		$product_id = $this->input->get(0);

		$product = $productDb->get('product_id='.$product_id)[0];

		if (!is_numeric($product_id) || !$product) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$updateProduct = array();
		$updateProduct['product_id'] = $product_id;
		$updateProduct['deleted'] = true;

		$productDb->update('product', $updateProduct);

		header('Location: /php_project/application/public/editor/index');
		exit;
	}
}