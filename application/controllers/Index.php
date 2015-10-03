<?php

namespace Controllers;

class Index extends Base {

	public function index() {
		$categories = new \Models\Category();
		$allCategories = $categories->find();

		$this->view->appendToLayout('body', 'index');
		$this->view->display('layouts.default', $allCategories);
	}
}