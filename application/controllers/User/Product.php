<?php

namespace Controllers\User;

class Product extends \Controllers\Base {

	private $user = null;
	private $userDb = null;

	public function buy() {
		if (!isset($_SESSION['userId'])) {
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

		$this->getUser();
		
		$price = $product['price'];
		if ($product['promotion_id'] !=null) {
			$promoDb = new \Models\Promotion();
			$discount = $promoDb->get('promotion_id = '.$product['promotion_id'])[0]['discount'];
			if ($discount>0) {
				$price = $price - $price*$discount/100;
			}
		}

		if ($this->user['cash'] < $price) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$orderDb = new \Models\Order();

		$newOrder = array();
		$newOrder['buyer_id'] = $_SESSION['userId'];
		$newOrder['product_id'] = $product_id;
		$orderId = $orderDb->add($newOrder);

		$this->userDb->update('user', array('user_id' => $_SESSION['userId'], 'cash' => $this->user['cash']-$price));

		$buyProduct = array();
		$buyProduct['product_id'] = $product_id;
		$buyProduct['quantity'] = $product['quantity']-1;

		$productDb->update('product', $buyProduct);
		header('Location: /php_project/application/public/');
	}

	public function sell() {
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$order_id = $this->input->get(0);
		$product_id = $this->input->get(1);

		$productDb = new \Models\Product();
		$orderDb = new \Models\Order();

		$order = $orderDb->get('order_id = '.$order_id)[0];
		$product = $productDb->get('product_id='.$product_id)[0];
		
		if (!is_numeric($product_id) || !is_numeric($order_id) || !$product || !$order) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$orderDb->update('order', array('order_id' => $order_id, 'status' => 'deleted'));
		
		if ($this->user==null) {
			$this->getUser();
		}
		
		$price = $product['price'];
		if ($product['promotion_id'] !=null) {
			$promoDb = new \Models\Promotion();
			$discount = $promoDb->get('promotion_id = '.$product['promotion_id'])[0]['discount'];
			if ($discount>0) {
				$price = $price - $price*$discount/100;
			}
		}

		$this->userDb->update('user', array('user_id' => $_SESSION['userId'], 'cash' => $this->user['cash']+$price));

		$sellProduct['product_id'] = $product_id;
		$sellProduct['quantity'] = $product['quantity']+1;

		$productDb->update('product', $sellProduct);

		header('Location: /php_project/application/public/user/profile');
	}

	public function cart() {
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->getUser();

		$productDb = new \Models\Product();
		$userProducts = $productDb->getOrderedProducts($_SESSION['userId']);

		$data = array();
		$data[] = $this->user;
		$data[] = $userProducts;

		$this->view->appendToLayout('body', 'myCart');
		$this->view->display('layouts.default', $data);
	}

	public function order() {
		if (!isset($_SESSION['userId'])) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$order_id = $this->input->get(0);
		$orderDb = new \Models\Order();
		$order = $orderDb->get('order_id = '.$order_id)[0];

		if (!is_numeric($order_id) || !$order) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$orderDb->update('order', array('order_id' => $order_id, 'status' => 'closed'));

		header('Location: /php_project/application/public/user/product/cart');
	}

	private function getUser() {
		$this->userDb = new \Models\User();
		$this->user = $this->userDb->get('user_id = '.$_SESSION['userId'])[0];
	}
}