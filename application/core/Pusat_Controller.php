<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pusat_Controller extends CI_Controller {
	private $data	= array();
	public 	$sesi 	= array();
	function __construct(){
		parent::__construct();
		$this->set_enqueue();
		$this->set_sesi();
	}
	public function set_enqueue($custom=array()){
		$n_custom = count($custom);
		$this->data['css'] = array(
			'css/bootstrap.min.css'
			,'css/bootstrap-reset.css'
			,'font-awesome/css/font-awesome.min.css'
			,'css/owl.carousel.css'
			,'css/style.css'
			,'css/style-responsive.css'
		);
		$this->data['js']	= array(				
				'js/jquery-1.8.3.min.js'
				,'js/bootstrap.min.js'
				,'js/jquery.js'
				,'js/respond.min.js'
				,'js/jquery.scrollTo.min.js'
				,'js/jquery.customSelect.min.js'
				,'js/jquery.sparkline.js'
				,'js/jquery.nicescroll.js'
				,'js/owl.carousel.js'
				,'js/common-scripts.js'
				,'js/count.js'
				,'js/deprecated.js'
				,'js/bootstrap-typeahead.js'
				,'js/program.custom.js'
				,'js/datatables/jquery.dataTables.min.js'
				,'js/datatables/dataTables.bootstrap.js'
				,'js/datatables/dataTables.buttons.min.js'
				,'js/datatables/buttons.bootstrap.min.js'
				,'js/datatables/dataTables.custom.js'
			);

		if ($n_custom > 0) {
			if (array_key_exists('css', $custom)) {
				$this->data['css'] = array_merge($this->data['css'],$custom['css']);
			}
			if (array_key_exists('js', $custom)) {
				$this->data['js'] = array_merge($this->data['js'],$custom['js']);
			}
		}
	}
	public function get_enqueue_css(){
		return $this->data['css'];
	}
	public function get_enqueue_js(){
		return $this->data['js'];
	}
	public function load_template_header($custom=array()){
		$data['ResourceCSS'] = $this->get_enqueue_css();
		$data				 = $this->merge_two_arrays($data,$custom);
		$this->load->view('templates/header',$data);
	}
	public function load_template_footer($custom=array()){
		$data['ResourceJS']	 = $this->get_enqueue_js();
		$data				 = $this->merge_two_arrays($data,$custom);
		$this->load->view('templates/footer',$data);
	}

	public function merge_two_arrays($ori=array(),$custom=array()){
		$n_custom	 = count($custom);
		if ($n_custom > 0){
			$ori = array_merge($ori,$custom);
		}
		return $ori;
	}
	public function set_sesi(){
		$this->sesi = $this->session->userdata();
	}

	public function cek_session_login(){
		if (isset($this->sesi['id'])) {
			redirect('home','refresh');
		}
	}

	public function cek_no_session_login(){
		if (!isset($this->sesi['id'])) {
			redirect('login/index','refresh');
		}
	}
	
	//----------datatables------------------//
	function change_keys_with_numb($data=array()){
		$n = count($data);
		$send =array();
		for ($i=0; $i < $n; $i++) {
			$count_val= count($data[$i]);
			$numb_keys= $this->numbers_keys($count_val);
			$send []  = array_combine($numb_keys, $data[$i]);
		}
		return $send;
	}
	function numbers_keys($count=0){
		$send =array();
		for ($i=0; $i < $count; $i++) {
			$send[]=$i;
		}
		return $send;
	}

}
