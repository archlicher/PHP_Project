<?php

namespace Models;

class Product extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'products'));
	}

	public function getProductsWithDiscount() {
		$query = "SELECT *, pr.discount as 'discount' FROM {$this->table} p LEFT JOIN promotions pr ON pr.promotion_id = p.promotion_id WHERE p.quantity > 0";
		return $this->db->prepare($query)->execute()->fetchAllAssoc();
	}

	public function getByCategory($id) {
		$query = "SELECT * FROM {$this->table} p JOIN products_categories pc ON pc.product_id = p.product_id WHERE pc.category_id = ? AND quantity > 0";
		$this->db->prepare($query, array($id));
		return $this->db->execute()->fetchAllAssoc();
	}

	public function getProductsByBuyer($id) {
		$query = "SELECT *, o.order_id AS 'order_id' FROM {$this->table} p JOIN orders o ON o.product_id = p.product_id WHERE o.buyer_id = ? AND o.status = 'closed'";
		$this->db->prepare($query, array($id));
		return $this->db->execute()->fetchAllAssoc();
	}

	public function getOrderedProducts($id) {
		$query = "SELECT *, o.order_id AS 'order_id' FROM {$this->table} p JOIN orders o ON o.product_id = p.product_id WHERE o.buyer_id = ? AND o.status = 'open'";
		$this->db->prepare($query, array($id));
		return $this->db->execute()->fetchAllAssoc();
	}
}