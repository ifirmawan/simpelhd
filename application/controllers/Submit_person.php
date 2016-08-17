<?php
/**
* 
*/
class Submit_person extends Proses{
	
	function __construct(){
		parent::__construct();
		

	}
	public function index(){
		show_404();
	}
	
	public function new_person(){
		if (isset($_POST['nama_lengkap'])) {
			$data 		= $_POST;
			$unset_list	= array('rt_nomer','rt_ketua','rw_nomer','rw_ketua');
			$data 		= unset_larik($data,$unset_list);
			$nosys		= '0001';
			$pecahTL	= explode('-', $data['lahir_tanggal']);

			//$n2 = str_pad($n + 1, 5, 0, STR_PAD_LEFT);
			$data['NIK'] = NOBREBES.$pecahTL[2].$pecahTL[1].$pecahTL[0].$nosys;
			if ($id = $this->person->save_data($data)) {
				// kartu
				$kartukk['pengajuan_id'] = '1';
				$kartukk['rt_nomer']	 = $_POST['rt_nomer'];
				$kartukk['rw_nomer']	 = $_POST['rw_nomer'];
				$kartukk['rt_ketua']	 = $_POST['rt_ketua'];
				$kartukk['rw_ketua']	 = $_POST['rw_ketua'];
				$kartukk['petugas_id']	 = $this->sesi['id'];
				$kartukk['person_id']	 = $id;
				if ($this->pengajuan->save_data($kartukk)) {
					$person['id'] 		= $id;
					$person['name']		= $data['nama_lengkap'];
					$person['status']	= $data['status_keluarga'];
					$this->session->set_userdata('person',$person);
					redirect('new_person','refresh');
				}else{
					echo '<script>alert("gagal mengajukan kartu kk");</script>';
					redirect('new_person','refresh');	
				}
			}else{
				echo '<script>alert("gagal menyimpan");</script>';
				redirect('new_person','refresh');
			}
		}else{
			echo '<script>alert("submit tidak valid");</script>';
			redirect('new_person','refresh');
		}
	}
	public function update_person_step2(){
		if (isset($_POST['nopegi']) && isset($_POST['pegi'])) {
			$data 				= unset_larik($_POST,array('nopegi','pegi'));
			$data['pekerjaan']  = max($_POST['nopegi'],$_POST['pegi']);
			if ($this->person->update(array('id'=>$this->sesi['person']['id']),$data)){
				//if (isset($this->sesi['person']['status'])) {
					
				//}
				//$this->session->unset_userdata('person');
				redirect('welcome/BuatKKStep3','refresh');
			}else{
				echo '<script>alert("gagal memperbaharui data -_-");</script>';
				redirect('new_person','refresh');	
			}
		}else{
			echo '<script>alert("submit tidak valid");</script>';
			redirect('new_person','refresh');	
		}
	}
	public function new_kepkel(){
		if (CekIsiPenuh($_POST)) {
			if ((isset($_POST['nama'])) && ($id = $this->kepkel->save_data($_POST))) {
				$data['kk_id'] 				= $id;
				$data['nama_lengkap'] 		= $_POST['nama'];
				$data['status_keluarga']	= 1;
				$data['status_perkawinan'] 	= 2;
				$data['jenis_kelamin'] 		= 1;
				$data['alamat']				= $_POST['alamat'];
				if ($this->person->save_data($data)) {
					$person['id'] 		= $id;
					$person['name']		= $data['nama_lengkap'];
					$this->session->set_userdata('person',$person);
					redirect('welcome/kk_step/1','refresh');
				}else{
					$this->session->set_flashdata('errors_log','gagal menyimpan :(');
				}
			}else{
				$this->session->set_flashdata('errors_log','tidak valid');
			}
		}else{
			$this->session->set_flashdata('errors_log','Data harus diisi semua');
		}
		redirect('welcome/kk_setup','refresh');
	}

	public function new_member_family(){
		if (isset($_POST['nama_lengkap'])) {
			$nama 			= trim($_POST['nama_lengkap']); 
			if (!empty($nama)) {
				$data 		= $_POST;
				if (isset($data['passport_tgl_terakhir'])){
					if (!validateDate($data['passport_tgl_terakhir'])) {
						unset($data['passport_tgl_terakhir']);
					}
				}
				$data['kk_id']	= $this->sesi['person']['id'];
				if (!$this->person->save_data($data)) {
					$this->session->set_flashdata('errors_log','gagal menyimpan :(');
				}
			}
		}
		redirect('welcome/kk_step/1','refresh');
	}
	public function update_kepkel(){
		if (isset($_POST['id'])) {
			$data 				= $_POST;
			unset($data['id']);
			if (!$this->kepkel->update(array('id'=>$_POST['id']),$data)) {
				$this->session->set_flashdata('errors_log','tidak ada perubahan');
			}
			$person['id'] 		= $_POST['id'];
			$person['name']		= $data['nama'];
			$this->session->set_userdata('person',$person);
			redirect('welcome/kk_step/1','refresh');
		}else{
			$this->session->set_flashdata('errors_log','gagal menyimpan :(');
			redirect('welcome/kk_setup','refresh');
		}
	}
}
