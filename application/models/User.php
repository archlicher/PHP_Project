<?php

namespace Models;

class User extends \Models\Base {

	public function __construct() {
		parent::__construct(array('table'=>'users'));
	}

	public function getUser($username) {
		return $this->find(array('where' => 'username = '.'"'.$username.'"'));
	}
}