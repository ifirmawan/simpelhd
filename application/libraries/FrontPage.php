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
	public function load_content_view($fileName='',$data=array()){
		$this->load_template_header($data);
		$this->load->view($fileName,$data);
		$this->load_template_footer($data);
	}
	public function logina($username,$password){
		$where=array(
			'username'=>$username,
			'password'=>md5($password)
		);
		return $where;
	}
	
}