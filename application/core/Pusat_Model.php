<?php
class Pusat_Model extends CI_Model {
	public $table_name;
	public $column;
	public $data_entry;
	public $str_join;
	public $field_attr 	= array();
	public $field_values= array();
	public function __construct(){
		parent::__construct();
		$this->set_table_name();
	}
	
	public function set_table_name($param='login'){
		$this->table_name=$param;
		
	}

//---------------------------------- datatables center ----------------------------------------------------
	public function set_json_db_limit(){
		if (isset($_POST['length']) && isset($_POST['start'])) {
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		}
	}

	public function _get_datatables_query(){
		$this->db->from($this->table_name);
		$this->like_filter();
		$this->db->order_by('id','DESC');
		if(isset($_POST['order'])){
			$this->db->order_by($this->column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
	}
	public function get_datatables(){
		$this->set_json_db_limit();
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_all(){
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}

	public function count_filtered(){
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
//---------------------------------- end datatables center ----------------------------------------------------
	public function get_by_id($id){
		$this->db->from($this->table_name);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function save_data($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data){
		$this->db->update($this->table_name, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
	}

	public function GetFields(){
		return $this->db->list_fields($this->table_name);
	}
	public function GetAll(){
		return $this->db->get($this->table_name)->result_array();
	}
	public function get_where($where=array()){
		$query = $this->db->get_where($this->table_name,$where);
		if ($query->num_rows()) {
			return $query->result_array();
		}
		return false;
	}
	public function max_select($column='id'){
		$query = $this->db->select_max($column)->get($this->table_name);
		if ($query->num_rows() > 0) {
			$send = $query->result_array();
			return $send[0][$column];
		}
		return 0;
	}
	public function get_by_column($id=false,$by=NULL){
		if ($id && !is_null($by)) {
			$query = $this->get_by_id($id);
			if (count($query) > 0 && in_array($by, $this->column)) {
				return $query->$by;
			}
		}else{
			return false;
		}
	}
	public function like_filter(){
		$prefix = array('person','kepalakeluarga');
		foreach ($this->GetFields() as $key => $item) {
			if(isset($_POST['search']['value'])){
				$dicari		= $_POST['search']['value'];
				$field 		= $item;
				if (in_array($this->table_name, $prefix)) {
					$field 	= $this->table_name.'.'.$item;
				}
				if ($key == 0 ) {
					$this->db->like($field, $dicari);
				}else{
					$this->db->or_like($field, $dicari);
				}
			}
		}
	}
	public function column_add(){
		$this->get_field_attr();
		return ($this->dbforge->add_column($this->table_name, $this->field_values))? true : false;
	}
	public function get_field_attr(){
		$n_field_attr = count($this->field_attr);
		if ($n_field_attr > 0) {
			foreach ($this->field_attr as $key => $value) {
				$data[$value] = array( 'type' => 'VARCHAR','constraint' => '125');
			}
			$this->field_values = $data;
		}
	}
	public function get_table_by_column_list($column=array()){
			$n_column = count($column);
			if ($n_column > 0 && is_array($column)) {
				$column_imp	= implode("','", $column);
				$db_name		= $this->db->database;
				$cmd_str 		="SELECT DISTINCT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME IN ('".$column_imp."') AND TABLE_SCHEMA='".$db_name."'";
				$query			= $this->db->query($cmd_str);
				if ($query->num_rows()) {
					$result						= $query->result_array();
					$result_table_name= $result[0]['TABLE_NAME'];
					$this->set_table_name($result_table_name);
					$cek_intersection		= array_diff($column, $this->column);
					$n_cek_intersection	= count($cek_intersection);
					if ($n_cek_intersection > 0) {
							return $cek_intersection;
					}else{
							return $result_table_name;
					}
				}
			}
			return false;
	}

	public function like_multi_column($data=array()){
		$n_data = count($data);
		if ($n_data > 0) {
				$index = 0;
				foreach ($data as $key => $value) {
						if($index == 0) {
        			$this->db->like($key, $value);
    				}elseif( $index ==1){
        			$this->db->or_like($key, $value);
    				}
						$index++;
				}
				$query = $this->db->get($this->table_name);
				if ($query->num_rows() > 0) {
						foreach ($query->result() as $key => $value) {
								return intval($value->id);
						}
				}else{
						return false;
				}
		}
	}

	function get_enum_values($field=''){
		$type = $this->db->query( "SHOW COLUMNS FROM {$this->table_name} WHERE Field = '{$field}'" )->row( 0 )->Type;
		preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
		$enum = explode("','", $matches[1]);
		return $enum;
	}
}
