<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Dashboard{
	function __construct(){
		parent::__construct();
		
	}
	public function index(){		
		$this->load_admin_content_view('home');
	}
	public function kk_setup($id=false){
		//$data['labels'] 	= $this->labels->kepkel();
		//$data['fields']		= $this->labels->kepkel_field();
		$data['action']		= 'submit_person/new_kepkel';
		if ($id) {
			$data['action']	= 'submit_person/update_kepkel';
			$data['id']		= $id;
			$data['details']= (array)$this->kepkel->get_by_id($id);
		}
		if (isset($this->sesi['person'])) {
			$this->kk_step();
		}else{
			$this->load_admin_content_view('kk/kk-setup',$data);
		}
		
 	}
 	public function kk_step_content($step='1',$data=array()){
 		 	$data['keluarga']	= $this->person->get_by_kkid($this->sesi['person']['id']);
 			$data['perkawinan']			= $this->db->get_where('person',array('kk_id'=>$this->sesi['person']['id'],'status_perkawinan >='=>'2'))->result_array();
 			$data['jmlkel']				= count($data['keluarga']);
 			$data['goldar']				= GetGoldar();
 			$data['bukan_pegawai_negri']= GetKodeJob('B');
 			$data['pegawai_negri']		= GetKodeJob('A');
			$data['statuskel']			= get_status_kel();
			$data['kelainfisik']		= GetKelainanFisik();
			$data['penycct']			= GetPenyndangCacat();
			$data['pendakhir']			= GetPendidikanTerakhir();
			$data['agama']				= GetAgama();
			$data['gender']				= GetGender();
			$data['kawin']				= Get_sts_kawin();
			return $this->load->view('pages/kk/kk-step-'.$step,$data,true);
 	}
 	public function kk_step($step='1'){
 		if (isset($this->sesi['person']) && $this->sesi['person']['name']) {
 			$data['kodewil']			= NOBREBES;
 			$data['kepkel_id']			= $this->sesi['person']['id'];
 			$data['personidentity']		= $this->kepkel->get_by_id($this->sesi['person']['id']);
			$data['part']				= $this->kk_step_content($step,$data);
 			$this->load_admin_content_view('wizard-table',$data);
 		}else{
 			$this->kk_setup();
 		}
 	}
 	public function kk_done(){
 		if (isset($this->sesi['person'])) {
 			$this->session->unset_userdata('person');
 			$this->arsip_all_kepkel();
 		}
 	}
 	public function person_remove($id=''){
 		$id = decrypt_url($id);
 		if ($this->person->delete_by_id($id)) {
 			$this->session->set_flashdata('errors_log','gagal menghapus anggota keluarga :(');
 		}
 		redirect('Welcome/kk_step/1','refresh');
 	}
	public function petugas(){
		$this->load_admin_content_view('wew');
	}
	public function arsip(){
		$data['all'] = $this->person->ShowAll();
		$this->load_admin_content_view('arsip/all-person',$data);	
	}
	public function arsip_all_person(){
		$data['thead'] 		= array('No','NIK','Nama Lengkap','Status Keluarga','Jenis Kelamin','Status Perkawinan','Keluarga','action');
		$data['selector']	='tb-person';
		$data['link']		= site_url('export_json/run_datatables_person_withjoin');
		$this->load_admin_content_view('arsip/all-person-datatables-format',$data);		
	}
	public function arsip_all_kepkel(){
		$kolomkepkel 		=$this->labels->kepkel();
		array_push($kolomkepkel, 'aksi');
		$data['thead'] 		= $kolomkepkel;
		$data['selector']	='tb-kepkel';
		$data['link']		= site_url('export_json/run_datatables_kepkel');
		$this->load_admin_content_view('arsip/all-person-datatables-format',$data);		
	}
	public function arsip_person_by_kepkelid($id=0){

		$data['thead'] 		= array('No','NIK','Nama Lengkap','Status Keluarga','Jenis Kelamin','Status Perkawinan','aksi');
		$data['selector']	='tb-kepkel-details';
		$data['link']		= site_url('export_json/run_datatables_person_bykkid/'.$id);
		$this->load_admin_content_view('arsip/all-person-datatables-format',$data);		
	}
	public function atur_profil_kelurahan(){
		$data['errors'] = $this->session->flashdata('errors_log');
		$this->load_admin_content_view('atur/profil-kelurahan',$data);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login/index');
	}
}
