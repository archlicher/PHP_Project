<?php

namespace Models;

class Category extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'categories'));
	}
}