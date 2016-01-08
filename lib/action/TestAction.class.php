<?php
class TestAction extends Action{

	private static $instance = NULL;

	public function getInstance(){
		self::$instance = !self::$instance ? new TestAction() : NULL;
		return self::$instance;
	}

	public function index(){
		echo 'TestAction';
	}

	public function ok(){
		var_dump(Route::$routeInfo);
	}

}
