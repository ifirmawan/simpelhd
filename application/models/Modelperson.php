<?php
/**
* 
*/
class Modelperson extends Pusat_Model{
	private $list_column;
	function __construct(){
		parent::__construct();
		$this->set_table_name('person');
		$this->set_list_column();
	}
	public function set_list_column(){
		$this->list_column = array("`person`.`id`","`person`.`NIK`","`person`.`nama_lengkap`","`person`.`status_keluarga`","`person`.`jenis_kelamin`","`person`.`status_perkawinan`","`person`.`kk_id`");
	}

	public function get_details($id=0){
		return $this->db->get_where('person',array('id'=>$id))->result_array();
	}
	public function get_by_kkid($id=''){
		return $this->get_where(array('kk_id'=>$id));
	}
	public function get_base_person(){
		$this->db->select($this->list_column);
		$this->db->from('person');
		$this->db->join('kepalakeluarga',"`person`.`kk_id` = `kepalakeluarga`.`id`");
	}
	public function show_all(){
		$this->get_base_person();
		return $this->db->get()->result_array();
	}
	public function show_all_datatablesformat(){
		$this->set_json_db_limit();
		$this->get_base_person();
		$this->search_datatables_person();
		return $this->db->get()->result_array();
	}
	public function show_detail_by_kkid_datatablesformat($id=0){
		$this->set_json_db_limit();
		//$this->get_base_person();
		$this->db->from('person');
		$this->db->where('kk_id',$id);
		$this->search_datatables_person();
		return $this->db->get()->result_array();
	}
	public function base_count_all(){
		$this->get_base_person();
		return $this->db->count_all_results();
	}
	public function base_num_rows(){
		$this->get_base_person();
		return $this->db->get()->num_rows();
	}
	public function detailbase_num_rows($id=0){
		//$this->get_base_person();
		$this->db->from('person');
		$this->db->where('kk_id',$id);
		return $this->db->get()->num_rows();
	}
	public function search_datatables_person(){
		if (!is_null($this->list_column)) {
			foreach ($this->list_column as $key => $value) {
				if(isset($_POST['search']['value'])){
					$dicari		= $_POST['search']['value'];
					$field 		= $value;
					if ($key == 0 ) {
						$this->db->like($field, $dicari);
					}else{
						$this->db->or_like($field, $dicari);
					}
				}
			}
		}
	}
}
?>