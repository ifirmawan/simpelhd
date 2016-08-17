<?php
/**
* 
*/
class Export_json extends Dashboard{
	
	function __construct(){
		parent::__construct();
	}
	public function all_person(){
		$data = $this->person->show_all();
		echo json_encode($data);
	}
	public function all_kepkel(){
		$data = $this->db->get('kepalakeluarga')->result_array();
		echo json_encode($data);	
	}
	public function run_datatables_person(){
		$this->generate_datatables('person');
	}
	public function run_datatables_person_with_join(){
		$data['query'] = $this->person->show_all_datatablesformat();
		$data['tr']	   = $this->person->base_num_rows();
		$data['tf']	   = $this->person->base_count_all();
		$this->generate_datatables('person',$data);
	}
	public function run_datatables_kepkel(){
		$this->generate_datatables('kepkel');		
	}
	public function run_datatables_person_by_kkid($id=''){
		$this->db->select(array("`person`.`id`","`person`.`NIK`","`person`.`nama_lengkap`","`person`.`status_keluarga`","`person`.`jenis_kelamin`","`person`.`status_perkawinan`","`person`.`kk_id`"));
		$data['query'] = ($this->person->get_by_kkid($id))? $this->person->get_by_kkid($id) : array();
		//$this->person->ShowDetailByKKIDDatatablesFormat($id);
		$data['tr']	   = count($data['query']);
		$data['tf']	   = count($data['query']);
		$this->generate_datatables('person',$data);
	}


//-----------------------------------------------------------------------------------------------------------------------------------
//------------------ Codebase Datatables Functions ---------------------------------------------------------------------------------	
	public function generate_datatables($entitas='person',$custom=array()){
		$data['query'] 	= $this->$entitas->get_datatables();
		$data['tr'] 	= $this->$entitas->count_all();
		$data['tf']		= $this->$entitas->count_filtered();
		if (count($custom)>0) {
			$data 		= array_merge($data,$custom);
		}
		$data['larik']	= $this->source_add_column($data['query']);
		$data['source']	= $this->set_filter_data_source($data['larik']);
		$output			= array('draw'=>NULL,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>array());
		if ($data['source']) {
			$output['draw'] 			= NULL;
			$output['recordsTotal']		= $data['tr'];
			$output['recordsFiltered']	= $data['tf'];
			$output['data']				= $data['source'];
			if (isset($_POST['draw'])) {
				$output['draw'] 		= $_POST['draw'];
			}
		}
		echo json_encode($output);
	}
	function set_filter_data_source($filter=array()){
		$n_filter = count($filter);
		if ($n_filter > 0) {
			array_walk_recursive($filter, 'filter_values');
			return $this->change_keys_with_numb($filter);
		}else{
			return false;
		}
	}
	function source_add_column($data=array()){
		$n_data = count($data);
		if ($n_data > 0) {
			foreach ($data as $key => $value) {
				$data[$key]['aksi'] 	= $this->template_button_aksi($value['id']);
				//$this->ud_action($value['id']);
			}
		}
		return $data;
	}
	public function template_button_aksi($id=0,$action=array()){
		$button  = '<div class="btn-group" id="'.$id.'">';
  		$button .= '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">';
    	$button .= 'Aksi <span class="caret"></span></button>';
  		$button .= '<ul class="dropdown-menu" role="menu">';
    	$button .= '<li><a href="'.site_url('Welcome/kk_setup/'.$id).'">Ubah</a></li>';
    	$button .= '<li><a href="#">Hapus</a></li>';
    	$button .= '<li class="divider"></li>';
    	$button .= '<li><a href="#">Lainnya</a></li><li><a href="'.site_url('cetak/index/'.$id).'">Lihat PDF</a></li></ul></div>';
    	
    	return $button;
	}
	

}
?>