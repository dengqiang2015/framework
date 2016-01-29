<?php 
class validator{
	
	private $attribute;
	private $param;
	private $method;
	private $methodName;
	private $methodParam;
	private $msg;
	private $errMsg;
	private $jsonFormat;
	private static $msgMap = array(
		'string'			=>'The type of %s is not string',
		'length'			=>'The length of %s is not correct',
		'array'				=>'The type of %s is not array',
		'null'				=>'The type of %s is not null',
		'notNull'			=>'The type of %s is null',
		'int'				=>'The type of %s is not int',
		'bool'				=>'The type of %s is not bool',
		'object'			=>'The type of %s is not object',
		'float'				=>'The type of %s is not float',
		'floatLength'		=>'The float length of %s is not correct',
		'email'				=>'The format of %s is not email format',
		'phone'				=>'The format of %s is not phone format',
		'letter'			=>'The format of %s is not letter format',
		'number'			=>'The format of %s is not number format',
		'upperLetter'		=>'The format of %s is not upper letter format',
		'lowerLetter'		=>'The format of %s is not lower letter format',
		'upperFirstLetter'	=>'The format letter of %s is not upper first letter format',
		'ip'				=>'The format of %s is not ip format',
		'reMatch'			=>'The format of %s is not available',
		'require'			=>'The param of %s must be setted'
	);

	public function __construct($jsonFormat = false){
		$this->jsonFormat = $jsonFormat;
	}

	
	private function extractAttribute($data){	  
	  return list($this->param, $this->method, $this->methodParam) = $data;
    }


	private function string(){
		if(!is_string(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function length(){
		$len = strlen(current($this->param));
		
		if(isset($this->methodParam['equal'])){
			if($len = $this->methodParam['equal']){
				$this->addErrorMsg(key($this->param), __FUNCTION__);
			}
		}else if(isset($this->methodParam['min'])){
			if($len < $this->methodParam['min']){
				$this->addErrorMsg(key($this->param), __FUNCTION__);
			}
		}else if(isset($this->methodParam['max'])){
			if($len > $this->methodParam['max']){
				$this->addErrorMsg(key($this->param), __FUNCTION__);
			}
		}
	}
	
	private function _array(){
		if(!is_array(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}
	
	private function null(){
		if(!is_null(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function notNull(){
		if(is_null(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	public function object(){
		if(!is_object(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	
	private function int(){
		if(!is_integer(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function float(){
		if(!is_float(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	public function bool(){
		if(!is_bool(current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function floatLength(){
		$param = explode('.', current($this->param));
		$len = strlen($param[1]);
													

		if(isset($this->methodParam['equal'])){
			if($len = $this->methodParam['equal']){
				$this->addErrorMsg(key($this->param), __FUNCTION__);
			}
		}else{

			if(isset($this->methodParam['min'])){
				if($len < $this->methodParam['min']){
					$this->addErrorMsg(key($this->param), __FUNCTION__);
				}
			}

			if(isset($this->methodParam['max'])){
				if($len > $this->methodParam['max']){
					$this->addErrorMsg(key($this->param), __FUNCTION__);
				}
			}
		}

	}

	private function email(){
		$pattern = '/^[0-9a-zA-Z]+([-_.][0-9a-zA-Z]+)*@([0-9a-zA-Z]+[-.])+[0-9a-zA-Z]{2,5}$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function phone(){
		$pattern = '/^1[3|4|5|8]\d{9}$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function number(){
		$pattern = '/^\d+$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function letter(){
		$pattern = '/^[a-zA-Z]+$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function upperLetter(){
		$pattern = '/^[A-Z]+$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function lowerLetter(){
		$pattern = '/^[a-z]+$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	
	public function upperFirstLetter(){
		$pattern = '/^[A-Z].*/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}


	private function ip(){
		$pattern = '/^((25[0-5]|2[0-4]\d|[01]?\d\d?)($|(?!\.$)\.)){4}$/';
		if(!preg_match($pattern, current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function reMatch(){
		if(!preg_match($this->methodParam['pattern'], current($this->param))){
			$this->addErrorMsg(key($this->param), __FUNCTION__);
		}
	}

	private function addErrorMsg($param, $method){
		return $this->setMsg($param, self::$msgMap[$method]);
	}

	private function setMsg($param, $msg){
		$this->msg[$param] = array('msg' => sprintf($msg, $param));
	}

	private function getMsg(){
		return $this->msg;
	}


	private function format($data){
		!isset($data[2]) ? $data[2] = array() : '';
		return $data;
	}

	private function jsonEncode($msg = array()){
		if(empty($msg)){
			return '';
		}
		return json_encode($msg);
	}

	public function validator($data){
		foreach($data as $v){
			$v = $this->format($v);
			$this->extractAttribute($v);
			$this->{$this->method}();
		}

		if($this->jsonFormat){
			return $this->jsonEncode($this->getMsg());
		}

		return $this->getMsg();
	}
}

/*
$validator = new validator(true);
$rule = [
			[['f'=>10.223], 'floatLength', ['min'=>1, 'max'=>2]],
			[['l'=>11111], 'length', ['min'=>6]],
			[['i'=>'192.133.55.6'], 'ip'],
			[['r'=>'123eee!'], 'reMatch', ['pattern'=>'/^[0-9a-zA-Z]+$/']]
		];
$ret = $validator->validator($rule);
var_dump($ret);
*/