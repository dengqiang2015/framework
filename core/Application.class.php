<?php

import('config', 'RouteConfig');
import('core', 'Route');
import('core', 'ActionFactory');


class Application{
	
	private static $instance = NULL;
	private static $appName;
	private static $route = array();

	public static function getInstance(){
		!self::$instance && self::$instance = new Application();
		return self::$instance;
	}

	public function setApp($appName){
		self::$appName = $appName;
		return $this;
	}

	public function run(){

		Route::parse(RouteConfig::$routeMap);

		//$this->checkPHPScript() && $this->runPHPScript();

		return $this->checkActionMethod() && $this->runActionMethod();
	}

	public function checkActionMethod(){

		return isset(Route::$routeInfo['action']) && isset(Route::$routeInfo['method']);

	}

	public function runActionMethod(){

		return ActionFactory::callAction(Route::$routeInfo['action'], Route::$routeInfo['method']);

	}

	public function checkPHPScript(){
		
		return Route::$routeInfo['extension'] == 'php';

	}

	public function runPHPScript(){
		if(file_exists(ROOT . '/'. Route::$routeInfo['page'])){
			include(ROOT . '/'. Route::$routeInfo['page']);
		}
		header("HTTP/1.0 404 Not Found");
		exit;
	}

}
