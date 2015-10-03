<?php

namespace Models;

class Product extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'products'));
	}

	public function getByCategory($id) {
		$query = "SELECT * FROM {$this->table} p JOIN products_categories pc ON pc.product_id = p.product_id WHERE pc.category_id = ?";
		$this->db->prepare($query, array($id));
		return $this->db->execute()->fetchAllAssoc();
	}

	public function getProductsByBuyer($id) {
		$query = "SELECT * FROM {$this->table} p JOIN orders o ON o.buyer_id = p.user_id WHERE p.user_id = ? AND o.status = 'closed'";
		$this->db->prepare($query, array($id));
		return $this->db->execute()->fetchAllAssoc();
	}
}