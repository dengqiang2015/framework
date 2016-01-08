<?php
import('core', 'Action');
import('core', 'Model');

class ActionFactory{

	public static function callAction($action, $method){
		$action .= 'Action';
		import('lib/action', $action);

		if(!class_exists($action)){
			exit("Action $action Not Found");
		}

		$actionInstance = new $action();
		if(!method_exists($actionInstance, $method)){
			exit("Method $method Not Found");
		}


		return $actionInstance->$method();
	}

}
