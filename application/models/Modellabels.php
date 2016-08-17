<?php
/**
* 
*/
class ModelLabels extends Pusat_Model{
	
	function __construct(){
		parent::__construct();
	}
	public function kepkel(){
		return array(
			'No'
			,'Nama Kepala Keluarga'
			,'Alamat'
			,'Kode Pos'
			,'Telepon'
			,'RT'
			,'Ketua RT'
			,'RW'
			,'Ketua RW'
			,'Jumlah Anggota Keluarga');
	}
	public function kepkel_field(){
		$this->set_table_name('kepalakeluarga');
		$data = $this->GetFields();
		if (isset($data[0])) {
			unset($data[0]);
		}
		return $data;
	}
	public function kk_header($key=false){
		$data = array(
			'kiri'=>array('nama kepala Keluarga','alamat','RT/RW','Desa/Kelurahan')
			,'kanan'=>array('Kecamatan','Kabupaten/Kota','Kode Pos','Provinsi')
		);
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
}
?>