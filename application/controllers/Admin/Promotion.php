<?php

namespace Controllers\Editor;

class Promotion extends \Controllers\Base {

		public function remove() {
		if(!isset($_SESSION['userId']) &&  $_SESSION['admin']!=true) {
			header('Location: /php_project/application/public/');
			exit;
		}
		
		$promotionDb = new \Models\Promotion();
		$promotion_id = $this->input->get(0);

		$promotion = $promotionDb->get('promotion_id='.$promotion_id)[0];

		if (!is_numeric($promotion_id) || !$promotion) {
			header('Location: /php_project/application/public/');
			exit;
		}

		$updatePromotion = array();
		$updatePromotion['promotion_id'] = $promotion_id;
		$updatePromotion['deleted'] = true;

		$promotionDb->update('promotion', $updatePromotion);

		header('Location: /php_project/application/public/editor/index');
		exit;
	}
}
