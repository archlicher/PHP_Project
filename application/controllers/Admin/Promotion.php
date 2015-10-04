<?php

namespace Controllers\Editor;

class Promotion extends \Controllers\Base {

	public function edit() {
		if(!isset($_SESSION['userId']) && $_SESSION['editor']!=true &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		$promotion_id = $this->input->get(0);
		$promotionDb = new \Models\Promotion();
		$promotion = $promotionDb->get('promotion_id = '.$promotion_id)[0];

		if (isset($_POST['promotion_name']) || isset($_POST['discount'])) {
			$cleaner = new \Framework\Common();
			$name = $cleaner->normalize($_POST['promotion_name'], 'trim|xss|string');
			$discount = $cleaner->normalize($_POST['discount'], 'trim|xss|float');

			if ($name == $promotion['promotoin_name'] && $discount == $promotion['discount']) {
				header('Location: /php_project/application/public/editor/index');
				exit;
			}

			$updatePromotion = array();
			$updatePromotion['promotion_name'] = $name;
			$updatePromotion['discount'] = $discount;
			$updatePromotion['promotion_id'] = $promotion_id;
			$updatePromotion['user_id'] = $_SESSION['userId'];

			$promotionDb->update('promotion', $updatePromotion);

			header('Location: /php_project/application/public/editor/index');
			exit;
		}

		if (!is_numeric($promotion_id) || !$promotion) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$this->view->appendToLayout('body', 'editPromotion');
		$this->view->display('layouts.default', $promotion);
	}

	public function add() {
		if(!isset($_SESSION['userId']) && $_SESSION['editor']!=true &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}

		if (isset($_POST['promotion_name']) && isset($_POST['discount'])) {
			$cleaner = new \Framework\Common();
			$newPromo = array();
			$newPromo['promotion_name'] = $cleaner->normalize($_POST['promotion_name'], 'trim|xss|string');
			$newPromo['discount'] = $cleaner->normalize($_POST['discount'], 'trim|xss|int');
			$newPromo['user_id'] = $_SESSION['userId'];

			$promoDb = new \Models\Promotion();
			$promoDb->add($newPromo);

			header('Location: /php_project/application/public/editor/index');
			exit;
		}

		$this->view->appendToLayout('body', 'addPromotion');
		$this->view->display('layouts.default');
	}
}
