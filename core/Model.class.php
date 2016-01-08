<?php

class Model{
	
	private static $instance = NULL;

	public function getInstance(){
		self::$instance = !self::$instance ? new Model() : NULL;
		return self::$instance;
	}

}