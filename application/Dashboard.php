<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin{

	function __construct() {
		parent::__construct();
		$data['home'] 	= strtolower(__CLASS__).'/';
		
		$this->load->vars($data);
		
	}
	function index(){		
		$navigation			= array(
			'title' =>'Glite'
			,'items' => array('create new','summary')
		);
		$data['navbar_top']	= $this->template->widget('navigation', $navigation);
		$data['user_data']	= $this->session->userdata('logged_in');
		$data['items_menu']	= $this->items_menu();
		$data['charts_view']= $this->template->widget('charts');
    	$this->default_view('home',$data);
	}
	function penawaran_penjualan(){
		$data['model_name']	='sales_quo';
		$data['field_list'] = array('status','quo number','customer name','sales name','customer email','customer telp','date created','date expired');
		$this->focus_view('table_data',$data);
	}
	function penawaran_penjualan_new($step='1'){
		if (in_array($step, array('1','2'))) {
			$page = 'quotation_new_step_'.$step;
			$data = array();
			$this->form_new_quotation($page,$data);
		}else{
			$this->index();
		}

	}
	
	function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('welcome', 'refresh');
	}
	
}

