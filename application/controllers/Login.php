<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends FrontPage{
	
	function __construct(){
		parent::__construct();
		
	}

	function index(){
		$data['title']	='hello world';
		$this->portal('login',$data);
	}

	public function login_aksi(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$cek 	 = $this->auth->cek_login('login',$this->logina($username,$password));

		if($cek->num_rows() > 0){
			$userdata = $cek->result_array();
			$data_session=array(
				'id'=>$userdata[0]['id']
				,'name'=>$userdata[0]['username']
				,'role'=>$userdata[0]['user_role']
			);
			$this->session->set_userdata($data_session);
			redirect('home');
		} else {
			echo "<script> alert('Username/password salah !');</script>";
			$this->index();
		}
	}
	public function reset_pass_action(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[login.email]');
		if ($this->form_validation->run()) {
			echo "<script> alert('Maaf, email belum terdaftar, coba yang lain');</script>";
		}else{
			if (isset($_POST['email'])) {
				$UserdataByEmail 	= $this->db->get_where('login',array('email'=>$_POST['email']))->row();
				$Username 			= $UserdataByEmail->username;
				$randPassword		= GetRandomPass(6,8,true).$UserdataByEmail->id;
				$this->email->set_mailtype('html');
				$this->email->from('i.firmawan@jagokomputer.com', 'Admin SIMPELHAND');
				$this->email->to($_POST['email']);
				$this->email->subject('Reset password akun '.$Username.'[SIMPELHAND] ');
				$this->email->message('Gunakan Password baru ini <strong>'.$randPassword.'</strong> untuk masuk ke http://localhost:81/simpelhand/login dengan akun <h3>'.$Username.'</h3>');
				if ($this->email->send()) {
					if ($this->db->update('login',array('password'=>md5($randPassword)),array('id'=>$UserdataByEmail->id))) {
						echo "<script> alert('Reset password berhasil :) periksa email ".$_POST['email']." segera !');</script>";
					}else{
						echo "<script> alert('Reset password gagal :(. Sistem tidak dapat memperbaharui password.');</script>";
					}
				}else{
					echo "<script> alert('".$this->email->print_debugger()."');</script>";
				}
			}
		}
		$this->index();
	}
	
}