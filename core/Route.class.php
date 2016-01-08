<?php

class Route{

	public static $uri='';
	public static $url='';
	public static $routeInfo = array();

	public static function parse($routeMap = array()){

		self::$uri = self::getUri();

		self::$url = self::getUrl();

		self::$routeInfo = self::getRouteInfo();

		return;
		
	}

	private static function getUri(){
		return preg_replace('/\/+/', '/', $_SERVER["REQUEST_URI"]);
	}

	private static function getUrl(){
		return 'http://'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . self::$uri; 
	}

	private static function getRouteInfo(){

		$routeInfo = parse_url(self::$url);

		self::$routeInfo['port'] = $_SERVER['SERVER_PORT'];

		self::$routeInfo['query'] = isset($routeInfo['query']) ? $routeInfo['query'] : '';

		isset(self::$routeInfo['query']) && parse_str(self::$routeInfo['query'], self::$routeInfo['param']);

		self::$routeInfo['url'] = self::$url;
		
		isset(self::$routeInfo['query']) && self::$uri = str_replace(self::$routeInfo['query'], '', self::$uri);

		self::$routeInfo['page'] = trim(self::$uri, '?/&=');

		self::$routeInfo['extension'] = pathinfo(self::$routeInfo['page'], PATHINFO_EXTENSION);
		
		$parseResult = explode('/', self::$routeInfo['page']);

		$action = isset($parseResult[0])? trim($parseResult[0]) : 'Index';

		self::$routeInfo['action'] = isset($routeMap[$action]) ? $routeMap[$action] : ucwords($action);

		$method = isset($parseResult[1])? trim($parseResult[1]) : 'index';

		self::$routeInfo['method'] = !$method ? 'index' : $method;

		return self::$routeInfo;
	}
}
