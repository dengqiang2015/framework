<?php
error_reporting(E_ALL);
!defined('ROOT') && define('ROOT', dirname(__FILE__));

include ROOT . '/lib/func/common.func.php';

import('config', 'CommonConfig');

import('core', 'Application');

Application::getInstance()->setApp(CommonConfig::$app)->run();

//$obj = Application::getInstance();

//var_dump($obj);




