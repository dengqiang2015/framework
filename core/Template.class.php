<?php

import('plugin/smarty/libs', 'Smarty');

class Template extends Smarty{

	public $config_dir;

	public function __construct(){
			parent::__construct();
			$this->config_dir = "configs";//目录变量
			$this->caching = false;//关闭缓存
			$this->template_dir = ROOT . '/template/' . CommonConfig::$tpl_type . '/';//设置模板目录
			$this->compile_dir = ROOT ."/data/template/templates_c";//设置编译目录
			$this->cache_dir = ROOT ."/data/template/cache";//缓存文件夹
			$this->left_delimiter = "{";
			$this->right_delimiter = "}";
	}

	public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL){
		!$template && $template = Route::$routeInfo['action'] . '/'. Route::$routeInfo['method'] .'.html';
		parent::display($template, $cache_id, $compile_id, $parent);
	}

}
