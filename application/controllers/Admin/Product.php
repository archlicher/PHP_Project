<?php

namespace Controllers\Editor;

class Product extends \Controllers\Base {

	public function edit() {
		if(!isset($_SESSION['userId']) && $_SESSION['editor']!=true &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		
		$productDb = new \Models\Product();
		$product_id = $this->input->get(0);

		if (isset($_POST['name']) || isset($_POST['description']) || isset($_POST['price'])|| isset($_POST['quantity'])) {
			$updateProduct = array();

			$cleaner = new \Framework\Common();

			if (isset($_POST['name'])) {
				$name = $cleaner->normalize($_POST['name'], 'trim|xss|string');
				$updateProduct['name'] = $name;
			}

			if (isset($_POST['description'])) {
				$desciption = $cleaner->normalize($_POST['description'], 'trim|xss|string');
				$updateProduct['desciption'] = $desciption;
			}

			if (isset($_POST['price'])) {
				$price = $cleaner->normalize($_POST['price'], 'trim|xss|float');
				$updateProduct['price'] = $price;
			}

			if (isset($_POST['quantity'])) {
				$quantity = $cleaner->normalize($_POST['quantity'], 'trim|xss|int');
				$updateProduct['quantity'] = $quantity;
			}

			$updateProduct['product_id'] = $product_id;

			$productDb->update('product', $updateProduct);
			header('Location: /php_project/application/public/');
			exit;
		}

		$product = $productDb->get('product_id='.$product_id)[0];

		if (!is_numeric($product_id) || !$product) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->view->appendToLayout('body', 'editProduct');
		$this->view->display('layouts.default', $product);		
	}

	public function promo() {
		if(!isset($_SESSION['userId']) && $_SESSION['editor']!=true &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$promoDb = new \Models\Promotion();
		$product_id = $this->input->get(0);
		$productDb = new \Models\Product();
		$product = $productDb->get('product_id='.$product_id)[0];

		if (isset($_POST['name'])) {
			$updateProduct = array();
			$promoName = $_POST['name'];

			$promotion = $promoDb->get('promotion_name = "'.$promoName.'"')[0];

			if ($product['promotion_id'] == null) {
				$updateProduct['promotion_id'] = $promotion['promotion_id'];
				$updateProduct['product_id'] = $product['product_id'];
				$productDb->update('product', $updateProduct);

				header('Location: /php_project/application/public/editor/index');
				exit;
			} else {
				$oldPromo = $promoDb->get('promotion_id = '. $product['promotion_id'])[0];
				if ($oldPromo['discount']>= $promotion['discount']) {
					header('Location: /php_project/application/public/editor/index');
					exit;
				} else {
					$updateProduct['promotion_id'] = $promotion['promotion_id'];
					$updateProduct['product_id'] = $product['product_id'];
					$productDb->update('product', $updateProduct);

					header('Location: /php_project/application/public/editor/index');
					exit;
				}
			}
		}

		if (!is_numeric($product_id) || !$product) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$promos = $promoDb->find();

		$this->view->appendToLayout('body', 'addPromoProduct');
		$this->view->display('layouts.default', $promos);
	}
}