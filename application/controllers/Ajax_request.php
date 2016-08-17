<?php
/**
* 
*/
class Ajax_request extends Dashboard{
	
	function __construct(){
		parent::__construct();
	}
	public function edit_person_byone(){
		$post_key	= array_keys($_POST);
		$match 		= array_intersect($post_key, $this->person->GetFields());
		$n_match	= count($match);

		if ($n_match > 0) {
			$data = $_POST;
			unset($data['id']);
			if (isset($data['kelainan_fisik']) && $data['kelainan_fisik'] == 1) {
				$data['penyandang_cacat'] = NULL;
			}		
			if (isset($data['pekerjaan'])) {
				$kodeA = GetKodeJob('A');
				$kodeB = GetKodeJob('B');
				$key   = NULL;
				if ($key = array_search($data['pekerjaan'], $kodeA)) {
					$key ='A-'.$key;
				}elseif ($key = array_search($data['pekerjaan'], $kodeB)) {
					$key ='B-'.$key;					
				}		
				if (!is_null($key)) {
					$data['pekerjaan'] = $key;
				}
			}
			return $this->person->update(array('id'=>$_POST['id']),$data);	
		}
	}
	public function get_job_json(){
		$kodeA = GetKodeJob('A');
		unset($kodeA[0]);
		$kodeB = GetKodeJob('B');
		unset($kodeB[0]);
		$data  = array_merge($kodeA,$kodeB);
		echo json_encode($data);
	}
	public function update_jml_kel(){
		if (isset($_POST['jml_anggota']) && isset($_POST['id'])) {
			$kepkel			= $this->kepkel->get_by_id($_POST['id']);
			if ($kepkel) {
				$jml_sebelumnya = $kepkel->jml_anggota;
				if ( $_POST['jml_anggota'] > $jml_sebelumnya) {
					if ($this->kepkel->update(array('id'=>$_POST['id']),array('jml_anggota'=>$_POST['jml_anggota']))) {
						echo '1';
					}else{
						echo 'gagal memperbaharui jumlah anggota';
					}
				}else{
					echo 'jumlah anggota tidak boleh kurang atau sama';
				}
			}else{
				echo 'sistem error';
			}
		}else{
			echo 'sistem error';
		}
	}
}
