<?php
/**
* 
*/
class Dashboard extends Pusat_Controller{
	
	function __construct(){
		parent::__construct();
		$this->cek_no_session_login();
	}
	
	public function load_admin_content_view($fileName='',$data=array()){
		if (isset($this->sesi['id'])) {
			$data['myprofile']	= $this->session->userdata();
		}
		$data['errors']			= $this->session->flashdata('errors_log');
		$this->load_template_header($data);
		$this->load->view('dashboard/menu-sidebar',$data);
		if (file_exists(APPPATH.'views/dashboard/'.$fileName.'.php')) {
			$this->load->view('dashboard/'.$fileName,$data);
		}else{
			echo $fileName;
			//$this->load->view($fileName,$data,true);
		}
		$this->load_template_footer($data);
	}
	public function select_option_view($name='',$data=array(),$id='',$selected=NULL){
		$n_data = count($data);
		if ($n_data > 0 && !empty($name)) {
			$view ='<select name="'.$name.'" class="form-control option-uniq" id="'.$id.'">';
			foreach ($data as $key => $value) {
				$cek='';
				if ((!is_null($selected)) && ($selected == $key)) {
					$cek='selected';
				}
				$view .='<option value="'.$key.'" '.$cek.'>'.$value.'</option>';
			}
			$view .='</select>';
			return $view;
		}else{
			return 0;	
		}
	}
}
?>
