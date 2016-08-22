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
		$this->dashboard($fileName,$data);
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
