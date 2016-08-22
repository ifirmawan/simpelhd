<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pusat_Controller extends CI_Controller {
	private $data	= array();
	public	$sesi 	= array();
	function __construct(){
		parent::__construct();
		$this->sesi = $this->session->userdata();
		$this->set_enqueue();
	}

//--------------------- Templates --------------------

	public function set_enqueue($custom=array()){
		$n_custom = count($custom);
		$this->data['css'] = array(
			'css/bootstrap.min'
			,'css/bootstrap-reset'
			,'font-awesome/css/font-awesome.min'
			,'css/owl.carousel'
			,'css/style'
			,'css/style-responsive'
		);
		$this->data['js']	= array(				
				'base/jquery-1.8.3.min'
				,'base/jquery'
				,'base/bootstrap.min'
				,'base/deprecated'
				,'plug-in/respond.min'
				,'plug-in/jquery.scrollTo.min'
				,'plug-in/jquery.customSelect.min'
				,'plug-in/jquery.sparkline'
				,'plug-in/jquery.nicescroll'
				,'plug-in/owl.carousel'
				,'plug-in/common-scripts'
				,'plug-in/count'
				,'plug-in/bootstrap-typeahead'
				,'datatables/jquery.dataTables.min'
				,'datatables/dataTables.bootstrap'
				,'datatables/dataTables.buttons.min'
				,'datatables/buttons.bootstrap.min'
				,'datatables/dataTables.custom'
				,'my-stuff/simpel.program'
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

	function load_enqueue(){
		foreach ($this->data['css'] as $key => $value) {
			$this->template->stylesheet->add(base_url().'assets/'.$value.'.css');
		}
		foreach ($this->data['js'] as $key => $value) {
			$this->template->javascript->add(base_url().'assets/js/'.$value.'.js');
		}
	}

	function set_attribute_view($data=array()){
		(isset($data['title']))? $this->template->title 	=$data['title'] : $this->template->title 	= 'Welcome!';
		(isset($data['footer']))? $this->template->footer 	=$data['footer'] : $this->template->footer 	= 'Professional Software Development';
	}

	function base_view($page='',$data=array()){
		$this->load_enqueue();
		$this->set_attribute_view($data);
        $this->template->content->view('pages/'.$page, $data);
       	$this->template->publish();
	}
	function dashboard($page='home',$data=array()){
		$this->template->set_template('templates/dashboard');
		$data['bar_navigation_top'] = $this->template->widget('navigation',$data);
		$data['bar_menu_side'] 		= $this->template->widget('sidebar',$data);
		$this->base_view($page,$data);
	}
	function portal($page='login',$data=array()){
		$this->base_view($page,$data);
	}
	
//---------- session ---------------------

	function cek_session_login(){
		if (isset($this->sesi['id'])) {
			redirect('home','refresh');
		}
	}

	function cek_no_session_login(){
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
