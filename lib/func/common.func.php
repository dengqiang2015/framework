<?php

function __autoload($className){
	if(file_exists(ROOT . '/' . $className . ".class.php")){
		return include ROOT . '/' . $className . ".class.php";  
	}
	return false;
} 

function import($libName, $className){

	if(file_exists(ROOT . '/' . $libName . '/' . $className . '.class.php')){
		return include ROOT . '/' . $libName . '/' . $className . '.class.php' ;
	}
	return false;
}
