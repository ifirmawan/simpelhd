<?php
/**
* 
*/
class Modelkonfig extends Pusat_Model{
	
	function __construct(){
		parent::__construct();
		$this->set_table_name('kelurahan_config');
	}
	public function get_by_key($key=''){
		$data = $this->get_where(array('kunci'=>$key));
		return $data[0]['isi'];
	}
}
