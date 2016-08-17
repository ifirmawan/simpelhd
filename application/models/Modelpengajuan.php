<?php
/**
* 
*/
class Modelpengajuan extends Pusat_Model{
	
	function __construct(){
		parent::__construct();
		$this->set_table_name('daftar_pengajuan');
	}
	public function get_enum_jenis(){
		return $this->get_enum_values('pengajuan_id');
	}
}