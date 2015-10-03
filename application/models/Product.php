<?php

namespace Models;

class Product extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'products'));
	}
}