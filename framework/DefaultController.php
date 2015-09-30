<?php

namespace Framework;

class DefaultController {
	/**
	 * 
	 * @var \Framework\App
	 */
	public $app;
	/**
	 * 
	 * @var \Framework\View
	 */
	public $view;
	/**
	 * 
	 * @var \Framework\App->getConfig()
	 */
	public $config;
	/**
	 * 
	 * @var \Framework\InputData
	 */
	public $input;

	public function __construct() {
		$this->app = \Framework\App::getInstance();
		$this->view = \Framework\View::getInstance();
		$this->config = $this->app->getConfig();
		$this->input = \Framework\InputData::getInstance();
	}
}