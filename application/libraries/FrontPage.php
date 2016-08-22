<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class FrontPage extends Pusat_Controller{
	
	function __construct(){
		parent::__construct();
		$this->cek_session_login();
	}
	
	public function logina($username,$password){
		$where=array(
			'username'=>$username,
			'password'=>md5($password)
		);
		return $where;
	}
	
}