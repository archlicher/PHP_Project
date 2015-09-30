<?php

namespace Controllers;

class Index extends \Framework\DefaultController {
	
	public function index() {
/*		$val = new \AR\Validation();
		$val->setRule()->setRule();
		$val->validate();
*/
		$this->view->appendToLayout('body', 'index');
		$this->view->display('layouts.default');
	}
}