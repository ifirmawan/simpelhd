<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_auth extends Pusat_Model{

	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}
	
}