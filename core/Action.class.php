<?php
import('core', 'Template');

class Action{
	
	private static $instance = NULL;
	public $tpl;

	public function getInstance(){
		!self::$instance ? self::$instance = new Action() : NULL;
		return self::$instance;
	}

	public function __construct(){
		$this->tpl = new Template;
	}

}
