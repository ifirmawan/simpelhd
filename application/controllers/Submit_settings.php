<?php
/**
* 
*/
class Submit_settings extends Proses{
	
	function __construct(){
		parent::__construct();
	}
	public function set_config_kelurahan(){
		$data = array();
		$keys = array_keys($_POST);
		foreach ($keys as $key => $value) {
			$data['kunci']	= $value;
			$data['isi']	= $_POST[$value];
			if ($id = $this->get_key_exist($value)) {
				$this->konfig->update(array('id'=>$id),$data);
			}else{
				if (!$this->konfig->save_data($data)) {
					$this->session->set_flashdata('errors_log','gagal mengatur profil kelurahan :(');
				}
			}
		}
		redirect('welcome/atur_profil_kelurahan','refresh');
	}
	public function get_key_exist($value=''){
		$cek 	= $this->konfig->get_where(array('kunci'=>$value));
		$n_cek  = count($cek);
		return ($n_cek > 0)? $cek[0]['id'] : false;
	}

}