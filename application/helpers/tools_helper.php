<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
	date_default_timezone_set('Asia/Jakarta');

	function getUriSegments() {
		return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}

	function IsNullOrEmptyString($question){
		return (!isset($question) || trim($question)==='');
	}
	function unset_larik($larik,$unset) {
		foreach($unset as $value) {
			if(array_key_exists($value,$larik)){
				unset($larik[$value]);
			}
		}
		return $larik;
	}
	function dumpbool($label, $expr) {
		print "$label: " . ($expr ? "TRUE" : "FALSE") . "\n";
	}
	
	// Be silent about E_NOTICE errors, but make a note if we see one
	function _isdef_error_handler( $errno, $errstr, $errfile, $errline, $errcontext ) {
		$GLOBALS['_isdef_error_detected'] = TRUE; return TRUE;
	}
	
	// enable the error handler
	function isdef_begin() {
		if (empty($GLOBALS['_isdef_error_handler_enabled'])) {
			$GLOBALS['_isdef_error_handler_enabled'] = TRUE;
			set_error_handler("_isdef_error_handler",E_NOTICE);
		} _isdef_reset();
	}
	// reset the error handler
	function _isdef_reset() {
		unset($GLOBALS['_isdef_error_detected']);
	}
	// disable the error handler
	function isdef_end() {
		if (!empty($GLOBALS['_isdef_error_handler_enabled'])) {
			restore_error_handler();
			unset($GLOBALS['_isdef_error_handler_enabled']);
		}
	}

	// see if the variable is defined by seeing if an error was detected
	function isdef($var) {
		if (!empty($GLOBALS['_isdef_error_detected'])) {
				_isdef_reset(); return FALSE;
			} return TRUE;
	}
	function table_template(){
		$template = array(
			'table_open'            => '<div class="table-responsive"><table class="table table-bordered dataTable">',
			'thead_open'            => '<thead>',
			'thead_close'           => '</thead>',
			'heading_row_start'     => '<tr>',
			'heading_row_end'       => '</tr>',
			'heading_cell_start'    => '<th>',
			'heading_cell_end'      => '</th>',
			'tbody_open'            => '<tbody>',
			'tbody_close'           => '</tbody>',
			'row_start'             => '<tr>',
			'row_end'               => '</tr>',
			'cell_start'            => '<td>',
			'cell_end'              => '</td>',
			'row_alt_start'         => '<tr>',
			'row_alt_end'           => '</tr>',
			'cell_alt_start'        => '<td>',
			'cell_alt_end'          => '</td>',
			'table_close'           => '</table></div>'
		);
		return $template;
	}
	function pagination_config($url='',$table='',$per=''){
        $ci 		= &get_instance();
        $attr 		= new Jvm_Model();
        $table 	= $attr->attribute['prefix'].$table;
        //pagination settings
        $config['base_url']       = site_url($url);
        $config['total_rows']     = $ci->db->count_all($table);
        $config['per_page']       = $per;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination pagination-sm pg-nav">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['anchor_class'] = 'follow_link';
        return $config;
	}

	function array_keys_exist( array $array, $keys ) {
		$count = 0;
		if ( ! is_array( $keys ) ) {
			$keys = func_get_args();
			array_shift( $keys );
		}
		foreach ( $keys as $key ) {
			if ( array_key_exists( $key, $array ) ) {
				$count ++;
			}
		}
		return count( $keys ) === $count;
	}

	function encrypt_url($string) {
		$key = "IW_979805"; //key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$test[$char]= ord($char)+ord($keychar);
			$result.=$char;
		}
		return urlencode(base64_encode($result));
	}
	function decrypt_url($string) {
		$key = "IW_979805"; //key to encrypt and decrypts.
		$result = '';
		$string = base64_decode(urldecode($string));
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	

	function folder_exist($folder){
		// Get canonicalized absolute pathname
		$path = realpath($folder);
		// If it exist, check if it's a directory
		return ($path !== false AND is_dir($path)) ? $path : false;
	}
	
	function get_status_class($id=false){
		if($id){
			$class =array('default','primary','warning','info','success');
			return $class[$id-1];
		}
		return false;
	}
	function get_count_item_cart(){
		$ci =&get_instance();
		echo $ci->count_item_cart();
	}
	function CekIsiPenuh($data=array()){
		$ci =&get_instance();
		if(count($data) > 0){
			foreach($data as $key => $value){
				if ($key!='Kenaikan_Harga' && $key!=='stock') {
					$cek[] =array('field'=>$key,'label'=>$key,'rules'=>'trim|required');
				}
			}
			$ci->form_validation->set_rules($cek);
			return $ci->form_validation->run();
		}
	}
	function get_calculate_date($duedate){
         $now = time(); // or your date as well
         $duedate = strtotime($duedate);
         $datediff = $now - $duedate;
         return floor($datediff/(60*60*24));
    }
    function table_templates(){
	$template = array(
	    'table_open'            => '<table style="width: 100%;" aria-describedby="jvm-datatables_info" role="grid" id="jvm-datatables" class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0">',
        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',
        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',
        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',
        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',
        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',
        'table_close'           => '</table>'
		);
		return $template;
    }

  function filter_values(&$item, $key) {
		$ci 	=&get_instance();
		switch ($key) {
			case 'nama':
				$item 	= ucfirst($item);
				break;
			case 'jenis_kelamin':
				$item 	= TransfromFunc($item,'GetGender');
				//$item 	= $item;
				break;
			case 'status_keluarga':
				$item 	= TransfromFunc($item,'get_status_kel');
				break;
			case 'status_perkawinan':
				$item 	= TransfromFunc($item,'get_sts_kawin');
				break;	
			case 'kk_id':
				$item 	= 'Bpk. <strong >'.ucfirst(GetKepKelById($item,'nama')).'</strong>';
				break;
			default:
				$item 	= $item;
				break;
		}
	}
	function TransfromFunc($item='0',$FuncName='get_status_kel'){
		$item 	= $item;
		if (!is_null($item) && !empty($item)) {
			$item = $FuncName($item);	
		}
		return $item;
	}

	function role_name_by_id($id=''){
		$ci =&get_instance();
		$query = $ci->db->get_where('users_roles',array('id'=>$id));
		$role_name='none';
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->role_name;
		}else{
			return 'none';
		}
	}
	function unset_range_of_range($data=array(),$start=0,$end=false){
		($end)? $n=$end  : $n =count($data);
		for($i =$start; $i < $n ; $i++){
			unset($data[$i]);
		}
		return $data;
	}
	function cus_detail_by($id='',$spesific='cus_name'){
		$ci 	=&get_instance();
		$data 	=$ci->db->get_where('customers',array('id'=>$id));
		$fields = $ci->db->list_fields('customers');
		if ($data->num_rows() > 0 && in_array($spesific, $fields)) {
			foreach ($data->result_array() as $key => $value) {
				return $value[$spesific];
			}
		}else{
			return false;
		}

	}
	
	function check_multi_keys_array($keys=array(),$data=array()){
		$n =count($keys);
		if ($n > 0 && count($data) > 0) {
			$i=0;
			foreach ($keys as $k => $val) {
				if (isset($data[$val])) {
					$i++;
				}
			}
			return ($n==$i)? true : false;
		}else{
			return false;
		}
	}

	function timeleft($time=false){
		$time = trim($time);
		if ($time) {
			$time1 = new DateTime($time); // string date
			$time2 = new DateTime('now');
			//$time2->setTimestamp(1327560334); // timestamps,  it can be string date too.
			$interval =  $time2->diff($time1);
			return $interval->format("%d hari %H jam %i menit %s detik lalu");
		}else{
			return 0;
		}
	}
	function duedate(){
		$duedate=date_create(date('Y-m-d'));
		date_add($duedate,date_interval_create_from_date_string('14 days'));
		return date_format($duedate,'Y-m-d');
	}

	
	function sentence_case($string) {
    	$sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    	$new_string = '';
    	foreach ($sentences as $key => $sentence) {
        	$new_string .= ($key & 1) == 0?
            	ucfirst(strtolower(trim($sentence))) :
            	$sentence.' ';
    	}
    	return trim($new_string);
	}
	
	function lower_case(&$item,$key){
		$item=strtolower($item);
	}

	
	function data_get_by_id($id=0,$table_name='brosur'){
		$ci 	= &get_instance();
		return $ci->db->get_where($table_name,array('id'=>$id))->row();
	}
	
	
	function get_indo_date($source='0000-00-00'){
			$w 			= date('w',strtotime($source));
			$d 			= date('d',strtotime($source));
			$m 			= date('n',strtotime($source));
			$y 			= date('Y',strtotime($source));
			$hari 	= array('Minggu','Senin','Selasa','Rabu','Kamis',"jum'at",'sabtu');
			$bulan 	= array('none','Januari','Febrauri','Maret','April','Mei','Juni','July','Agustus','September','Oktober','November','Desember');
			$send 	= $hari[$w].', '.$d.' '.$bulan[$m].' '.$y;
			return $send;
	}
	function GetKodeJob($key=false){
		$data['A'] 	= array('pilih salah satu','Belum/Tidak Bekerja','Mengurus Rumah Tangga','Pelajar/Mahasiswa','Pensiunan','Pegawai Negri Sipil (PNS)','Tentara Nasional Indonesia (TNI)','Kepolisian RI (POLRI)','Perdagangan','Petani/Pekebun','Peternak','Nelayan/Perikanan','Industri','Konstruksi','Transportasi','Karyawan Swasta','Karyawan BUMN','Karyawan BUMD','Karyawan','Buruh','Buruh Tani/Perkebunan','Buruh Nelayan/Perikanan','Buuruh Peternakan','Pembantu Rumah Tangga','Tukang Cukur','Tukang Listrik','Tukang Batu','Tukang Kayu','Tukang Sol Sepatuu','Tukang Las/Pandai Besi','Tukang Jahit','Tukang Gigi','Penata Rias','Penata Busana','Penata Rambut','Mekanik','Seniman','Paraji','Perancang Busana','Penterjemah','Imam Masjid','Pendeta','Pastor','Wartawan','Ustadz/Muubaligh','Juru Masak','Promotor Acara','Anggota DPR-RI','Anggota DPD','Anggota BPK','Presiden','Wakil Presiden','Anggota Mahkamah Konstitusi','Anggota Kabinet/Kementrian','Duta Besar','Gubernur','Wakil Gubernur','Bupati','Wakil Bupati','Walikota','Wakil Walikota','Anggota DPRD Provinsi','Anggota DPRD Kabupaten/Kota');
		$data['B']	= array('pilih salah satu','Dosen','Guru','Pilot','Pengacara','Notaris','Arsitek','Akuntan','Konsultan','Dokter','Bidan','Perawat','Apoteker','Psikiater/Psikolog','Penyiar Televisi','Penyiar Radio','Pelaut','Peneliti','Sopir','Pialang','Paranormal','Pedagang','Perangkat Desa','Kepala Desa','Biarawati','Wiraswasta');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function get_status_kel($key=false){
		$data = array('pilih salah satu','Kepala Keluarga','Suami','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Famili Lain','Pembantu','Lainnya');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function GetKelainanFisik($key=false){
		$data = array('pilih salah satu','Tidak ada','ada');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function GetPenyndangCacat($key=false){
		$data = array('pilih salah satu','cacat fisik','cacat netra/buta','cacat rungu/wicara','cacat mental/jiwa','cacat fisik/mental','cacat lainnya');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function GetPendidikanTerakhir($key=false){
		$data = array('pilih salah satu','Tidak/Belum sekolah','Belum Tamat SD/Sederajat','Tamat SD/Sederajat','SLTP/Sederajat','SLTA/Sederajat','Diploma I/II','Akedemi/Diploma III/Sarjana Muda','Diploma IV/Strata I','Strata II','Strata III');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function GetAgama($key=false){
		$data = array('pilih salah satu','Islam','Kristen','Katholik','Hindu','Budha','Lainnya');
		return ($key && isset($data[$key]))? $data[$key] : $data;
	}
	function GetGolDar($key=false){
		$data = array('pilih salah satu','A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-','Tidak Tahu');
		return ($key && isset($data[$key]))? $data[$key] : $data;	
	}
	function GetGender($key=false){
		$data = array('pilih salah satu','laki-laki','Perempuan'); 
		return ($key && isset($data[$key]))? $data[$key] : $data;		
	}
	function get_sts_kawin($key=false){
		$data = array('pilih salah satu','Belum Kawin','Kawin','Cerai Hidup','Cerai Mati');
		return ($key && isset($data[$key]))? $data[$key] : $data;		
	}
	function ReplaceNullValue($value=NULL,$name='',$id=''){
		//if (is_null($value)) {
			return '<input name="'.$name.'" id="'.$id.'" class="form-control submit-editable" value="'.$value.'"/>';
		//}else{
		//	return $value;
		//}
	}
	function GetUmur($lahir='0000-00-00'){
		$pecah = explode('-', $lahir);
		return intval(date('Y') - $pecah[0]);
	}
	function GetKepKelById($id='',$spesific=false){
		$ci 	=&get_instance();
		$query  = $ci->kepkel->get_where(array('id'=>$id));
		return ($spesific && isset($query[0][$spesific]))? $query[0][$spesific] : $query;
	}
	function DirectSelectOptionsView($name='',$source=array(),$id='',$selected=NULL){
		$ci 	=&get_instance();
		return $ci->select_option_view($name,$source,$id,$selected);
	}
	function GetKonfigValByKey($kunci=''){
		$ci 	=&get_instance();
		return $ci->konfig->get_by_key($kunci);
	}

	function GetRandomPass($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

      return $password;
	}

	function validateDate($date){
    	$d = DateTime::createFromFormat('Y-m-d', $date);
    	return $d && $d->format('Y-m-d') === $date;
	}


