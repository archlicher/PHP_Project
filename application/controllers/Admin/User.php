<?php

namespace Controllers\Admin;

class User extends \Controllers\Base {
	
	public function index() {
		$this->setModel(get_class());
	}
}