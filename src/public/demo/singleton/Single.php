<?php
class Single{
	private static $instances = array();
	
	private function __construct(){
		
	}
	
	public static function getInstance(){
		$class = get_called_class();
		
		if (!isset(self::$instances[$class])){
			self::$instances[$class] = new $class();
		}
		
		return self::$instances[$class];
	}
	
	final public function __clone(){
		trigger_error('clonage interdit', E_USER_ERROR);
	}
}