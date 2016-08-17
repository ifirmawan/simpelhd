<?php
/**
* 
*/

class ThirdParty extends Pusat_Controller{
	
	protected $_instance;

	function __construct($instance){
		$this->_instance 	= $instance;	 
	}

    public function __call($method, $args) {
        return call_user_func_array(array($this->_instance, $method), $args);
    }

    public function __get($key) {
        return $this->_instance->$key;
    }

    public function __set($key, $val) {
        return $this->_instance->$key = $val;
    }
	/*public function __call($method, $args){
    	$this->pdf->$method($args[0]);
  	}*/
}
