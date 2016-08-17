<?php
/**
* 
*/
class Proses extends Pusat_Controller{
	
	function __construct(){
		parent::__construct();
		$this->cek_no_session_login();
		$this->cek_no_post();
	}
	public function cek_no_post(){
		$count_POST = count($_POST);
		if ($count_POST == 0) {
			redirect('home','refresh');
		}
	}
	public function kode_wilayah_brebes($key=false){
		$data['332901'] = 'Salem';
		$data['332902'] ='Bantarkawung';
		$data['332903'] ='Bumiayu';
		$data['332904'] ='Paguyangan';
		$data['332905'] ='Sirampog';
		$data['332906'] ='Tonjong';
		$data['332907'] ='Jatibarang';
		$data['332908'] ='Wanasari';
		$data['332909'] ='Brebes';
		$data['332910'] ='Songgom';
		$data['332911'] ='Kersana';
		$data['332912'] ='Losari';
		$data['332913'] ='Tanjung';
		$data['332914'] ='Bulakamba';
		$data['332915'] ='Larangan';
		$data['332916'] ='Ketanggungan';
		$data['332917'] ='Banjarharjo';
		return(isset($data[$key]))? $data[$key] : $data;
	}
}