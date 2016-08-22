<?php defined('BASEPATH') OR exit('No direct script access allowed');

class JVM_Controller extends CI_Controller{
	private $css_files;
	private $js_files;
	private $user_session;
	function __construct() {
		parent::__construct();
		$this->set_css_files();	
		$this->set_js_files();
		$this->set_user_session();
		$this->set_template_title();
	}
	function set_css_files($style=array()){		
		$this->css_files 	= array(
			'bootstrap/bootstrap.min'
			,'bootstrap/bootstrap-datepicker3.standalone.min'
			,'custom/custom.backend'
			,'custom/custom.jquery.tagit'
			,'custom/custom.tagit.ui-zendesk'
		);
		if ($style) {
			$this->css_files = array_merge($this->css_files,$style);
		}
	}
	function set_js_files($script=array()){
		$this->js_files 	= array(
			'jquery/jquery-2.1.4.min'
			,'jquery/jquery-ui.min'
			,'bootstrap/bootstrap.min'
			,'bootstrap/deprecated'
			,'custom/highcharts'
			,'jquery/jquery.tmpl.min'
			,'jquery/jquery.maxlength'
			,'bootstrap/bootstrap-typeahead'
			,'custom/custom.tag-it.min'
		);
		if ($script){
			$this->js_files = array_merge($this->js_files,$script);
		}
	}
	function set_attribute_view($data=array()){
		(isset($data['title']))? $this->template->title 	=$data['title'] : $this->template->title 	= 'Welcome!';
		(isset($data['footer']))? $this->template->footer 	=$data['footer'] : $this->template->footer 	= 'Professional Software Development';
	}
	function set_template_title(){
		if (!is_null( $title 		= $this->uri->segment(2))) {
			$this->template->title 	= strtoupper(replace_underc_with_space($title));
		}
	}
	function load_stylesheet(){
		foreach ($this->css_files as $key => $value) {
			$this->template->stylesheet->add(base_url().'assets/css/'.$value.'.css');
		}
	}
	function load_scriptjs(){
		foreach ($this->js_files as $key => $value) {
			$this->template->javascript->add(base_url().'assets/js/'.$value.'.js');
		}
	}
	function enqueue_dashboard(){
		$css_files 	= array(			
			'datatables/dataTables.bootstrap'
			//,'datatables/jquery.dataTables.min'
		);
		$js_files 	= array(
			'datatables/jquery.dataTables.min'
			,'datatables/dataTables.bootstrap'
			,'custom/custom.datatables'
		);
		$this->set_css_files($css_files);
		$this->set_js_files($js_files);
	}
	
	function enqueue_materialize(){
		$css_files = array(
			'materialize/material.min'
			,'materialize/material.fonts'
			,'materialize/styles'
			,'materialize/icon');
		$js_files  = array('materialize/material.min');
		$this->set_css_files($css_files);
		$this->set_js_files($js_files);
	}

	function check_login_true(){
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard','refresh');
		}
	}
	function check_login_false($value=''){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome','refresh');
		}	
	}


// ---------------------------------------------------------------------------------------------------------
	# Session userdata
	function setup_session_user($user_id=NULL){		
		if (!is_null($user_id)) {
			if ($userdata = $this->auth->userdata_by(array('id' => $user_id))) {
				$data['id'] 		= $userdata->id;
				$data['name'] 		= $userdata->user_name;
				$data['email']		= $userdata->user_email;
				$data['role_id']  	= $userdata->user_role_id;

				$this->session->set_userdata('logged_in',$data);
			}
		}
	}
	function set_user_session(){
		if ($this->session->userdata('logged_in')) {
			$this->user_session = $this->session->userdata('logged_in');
		}
	}
	function get_user_session(){
		return $this->user_session;
	}
	

// ----------------------------------------------------------------------------------------------------------
# VIEW CLASIFICATION

	function default_view($page='home',$data=array()){
		$this->load_stylesheet();
		$this->load_scriptjs();
		$this->set_attribute_view($data);
        $this->template->content->view('pages/'.$page, $data);
       	$this->template->publish();
	}
	function focus_view($page='home',$data=array()){
		$data['default_link'] = $this->uri->segment(2);
		$this->enqueue_dashboard();
		$this->load_stylesheet();
		$this->load_scriptjs();
		$this->set_attribute_view($data);
		$this->template->set_template('templates/focus');
        $this->template->content->view('pages/'.$page, $data);
       	$this->template->publish();
	}
	function form_new_quotation($page='quotation_new_step_1',$data=array()){
		$this->enqueue_dashboard();
		$this->load_stylesheet();
		$this->load_scriptjs();
		$this->set_attribute_view($data);
		$this->template->set_template('templates/form_new_quotation');
        $this->template->content->view('pages/'.$page, $data);
       	$this->template->publish();
	}
	
}

