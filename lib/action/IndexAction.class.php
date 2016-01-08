<?php
class IndexAction extends Action{

	private static $instance = NULL;

	public function getInstance(){
		self::$instance = !self::$instance ? new IndexAction() : NULL;
		return self::$instance;
	}


	public function index(){
		$var = 'index';
		var_dump($var);
		$this->tpl->assign('var', $var);
		$this->tpl->display();
	}

}
