<?php

namespace Models;

class Order extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'orders'));
	}
}