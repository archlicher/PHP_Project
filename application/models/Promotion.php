<?php

namespace Models;

class Promotion extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'promotions'));
	}
}