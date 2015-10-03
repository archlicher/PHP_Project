<?php

namespace Controllers\Editor;

class Product extends \Controllers\Base {

	public function edit() {
		if(!isset($_SESSION['userId']) || $_SESSION['editor']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if (isset($_POST)) {
			$updateProduct = array();

			$cleaner = new \Framework\Common();

			if (isset($_POST['name'])) {
				$name = $cleaner->normalize($_POST['name'], 'trim|xss|string');
				$updateProduct[] = $name;
			}

			if (isset($_POST['description'])) {
				$desciption = $cleaner->normalize($_POST['description'], 'trim|xss|string');
				$updateProduct[] = $desciption;
			}

			if (isset($_POST['price'])) {
				$price = $cleaner->normalize($_POST['price'], 'trim|xss|float');
				$updateProduct[] = $price;
			}

			if (isset($_POST['quantity'])) {
				$quantity = $cleaner->normalize($_POST['quantity'], 'trim|xss|int');
				$updateProduct[] = $quantity;
			}

			$updateProduct['product_id'] = $product_id;

			$productDb->update('product', $updateProduct);
			header('Location: /php_project/application/public/');
		}

		$product_id = $this->input->get(0);
		$productDb = new \Models\Product();
		$product = $productDb->get('product_id='.$product_id)[0];

		if (!is_numeric($product_id) || !$product) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->view->appendToLayout('body', 'editProduct');
		$this->view->display('layouts.default', $product);		
	}

	public function promo() {
		if(!isset($_SESSION['userId']) || $_SESSION['editor']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if (isset($_POST)) {
			$updateProduct = array();
			// GO FROM HERE
		}

		$product_id = $this->input->get(0);
		$productDb = new \Models\Product();
		$product = $productDb->get('product_id='.$product_id)[0];

		if (!is_numeric($product_id) || !$product) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$promoDb = new \Models\Promotion();
		$promos = $promoDb->find();

		$this->view->appendToLayout('body', 'addPromoProduct');
		$this->view->display('layouts.default', $promos);
	}
}