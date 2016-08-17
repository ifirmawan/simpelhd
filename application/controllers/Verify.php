<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Verify extends JVM_Controller{	
	function __construct(){
		parent::__construct();

	}
	function index(){
		$allpost	=$this->input->post(NULL,true);
		$this->form_validation->set_rules('user_name','Username','trim|required');
		$this->form_validation->set_rules('user_pass','password','trim|required|callback_cek_database');
		$this->form_validation->set_error_delimiters('<div class="alert alert-success alert-outline alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		if ($this->form_validation->run()==false){
			$errors[]	= validation_errors();
			$this->session->set_flashdata('errors_log',$errors);
			redirect ('front','refresh');
		}else{
			redirect ('Cpanel','refresh');
		} 	
	}
	function cek_database($password){
		$user_name	= $this->input->post("user_name");
		$hasil		= $this->auth->cek_login($user_name,$password);
		if(isset($hasil->id)){
			$this->user_id = $hasil->id;
			$this->sess_userdata_setup();
			return true;
		}else{
			$this->form_validation->set_message('cek_database','Invalid Username and password :( . Try again or Register');
			return false;
		}
	}
	function resetpass(){
		$this->form_validation->set_rules('user_email','user_email','trim|required|valid_email|is_unique[toko_users.user_email]');
		if ($this->form_validation->run()==false){
			if(!is_null($to=$this->input->post('user_email'))){
				$user_email = $this->input->post('user_email');
				$userdata	  = $this->auth->userdata_by(array('user_email'=>$to));
				$subject	  = 'Reset password Account '.config_item('site_name');
				$rand_pass  = random_string('alnum', 16);
				$msg		  = '<h2>Hello '.$userdata->user_name.' , reset password from '.config_item('site_name').'<h2>';
				$msg		 .='please login with password : <strong>'.$rand_pass.'</strong> and username : '.$userdata->user_name;
				$msg		 .='if you having problem, please contact this Email <strong>'.config_item('admin_email').'</strong>';
				if($this->send_email($to,$subject,$msg)){
					echo '1';
				}else{
					echo  $this->email->print_debugger(); //array('headers')
				}
			}else{
				echo "System Error:002 : bypass empty post";
			}
		}else{
			echo "Email address not registered, please try again ";
		}
	}
	
}
