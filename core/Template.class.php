<?php

import('plugin/smarty/libs', 'Smarty');

class Template extends Smarty{

	public $config_dir;

	public function __construct(){
			parent::__construct();
			$this->config_dir = "configs";//Ŀ¼����
			$this->caching = false;//�رջ���
			$this->template_dir = ROOT . '/template/' . CommonConfig::$tpl_type . '/';//����ģ��Ŀ¼
			$this->compile_dir = ROOT ."/data/template/templates_c";//���ñ���Ŀ¼
			$this->cache_dir = ROOT ."/data/template/cache";//�����ļ���
			$this->left_delimiter = "{";
			$this->right_delimiter = "}";
	}

	public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL){
		!$template && $template = Route::$routeInfo['action'] . '/'. Route::$routeInfo['method'] .'.html';
		parent::display($template, $cache_id, $compile_id, $parent);
	}

}
