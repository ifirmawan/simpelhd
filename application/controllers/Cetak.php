<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends ThirdParty{
	private $data;
	private $ci;
	function __construct(){
		require_once APPPATH.'/third_party/FPDF.php';
		parent::__construct(new FPDF('Landscape','mm','A4'));
		$this->ci 	= new CI_Controller();
		$this->set_data_by_lasturl();
	}
	public function header_loop($x=0,$y=0,$data=''){
		$this->SetXY($x,$y);
		$this->Cell(75,4,ucfirst($data),0,0,'L');
		$this->SetXY(60,$y);
		$this->Cell(75,4,':',0,0,'L');
		$this->SetXY(195,$y);
		$this->Cell(75,4,':',0,0,'L');
	}
	public function header_loop_vertical($x=0,$y=0,$counter=0,$data=array()){
		$n_data = count($data);
		if ($n_data > 0) {
			$nilai_y = $y;
			foreach ($data as $key => $value) {
				$this->header_loop($x,$nilai_y,$value);
				$nilai_y+=$counter;	
			}
		}
	}
	public function set_data_by_lasturl(){	
		$larik_url 	=$this->ci->uri->segment_array();
		$n_larik_url= count($larik_url);
		$last_url	= $larik_url[$n_larik_url];
		if ($query =$this->ci->kepkel->get_by_id($last_url)) {
			$this->data['kepkel']	= $query;
			$this->data['anggota']	= $this->ci->person->get_by_kkid($last_url);
		}
	}
	public function get_isikkheader_kiri(){
		if (!is_null($this->data)) {
			$data = array(
					$this->data['kepkel']->nama
					,$this->data['kepkel']->alamat
					,$this->data['kepkel']->rt.'/'.$this->data['kepkel']->rw
					,$this->ci->konfig->get_by_key('kel_nama')
				);
			return $data;
		}
	}
	public function get_isikkheader_kanan(){
		if (!is_null($this->data)) {
			$data = array(
					$this->ci->konfig->get_by_key('kec_nama')
					,$this->ci->konfig->get_by_key('kab_nama')
					,$this->data['kepkel']->kodepos
					,$this->ci->konfig->get_by_key('prov_nama')
				);
			return $data;
		}
	}
	public function index(){
		//if (is_null($this->data)) {
			$this->pdf_kk();
		//}else{
		//	echo 'tidak ada data yang dimuat';
		//}
	}
	public function pdf_kk(){
		$this->AddPage();
		$this->kk_header();
		$this->kk_konten_satu();
		$this->kk_konten_isi_vertikal_loop(44,6,array('nama_lengkap','NIK','jenis_kelamin','lahir_tempat','lahir_tanggal','agama','pendidikan_terakhir','pekerjaan','no'));
		$this->kk_konten_dua();
		$this->kk_konten_isi_vertikal_loop(114,6,array('status_perkawinan','status_keluarga'),'kk_konten_dua_isi');
		$this->Output();
	}
	public function kk_header()
	{
		$this->SetFont('Arial','B',20);
		$this->SetXY(100,5);
		$this->Cell(100,10,'Kartu Keluarga',0,0,'C');
		$this->kk_baris_satu();
	}
	public function kk_baris_satu(){
		$this->SetFont('Arial','',12);
		$this->kk_header_kiri();
		$this->kk_header_kiri_isi();
		$this->kk_header_kanan();
		$this->kk_header_kanan_isi();
	}
	public function kk_header_kiri(){
		$this->header_loop_vertical(15,15,5,$this->ci->labels->kk_header('kiri'));
	}
	public function kk_header_kiri_isi(){
		if (!is_null($this->data)) {
			$this->header_loop_vertical(63,15,5,$this->get_isikkheader_kiri());
		}
	}
	public function kk_header_kanan(){
		$this->header_loop_vertical(160,15,5,$this->ci->labels->kk_header('kanan'));	
	}
	public function kk_header_kanan_isi(){
		$this->header_loop_vertical(198,15,5,$this->get_isikkheader_kanan());		
	}
	public function kk_konten_satu(){
		$this->SetFont('Arial','',10);
		$this->SetXY(17,38);
		$this->Cell(15,6,'No',1,0,'C');
		$this->SetXY(32,38);
		$this->Cell(50,6,'Nama Lengkap',1,0,'C');
		$this->SetXY(82,38);
		$this->Cell(30,6,'NIK',1,0,'C');
		$this->SetXY(112,38);
		$this->SetFont('Arial','',8);
		$this->MultiCell(16,3,'jenis Kelamin',1,'C',0);
		$this->SetFont('Arial','',10);
		$this->SetXY(128,38);
		$this->Cell(40,6,'Tempat Lahir',1,0,'C');
		$this->SetXY(168,38);
		$this->MultiCell(16,3,'Tanggal Lahir',1,'C',0);
		$this->SetXY(184,38);
		$this->Cell(30,6,'AGAMA',1,0,'C');
		$this->SetXY(214,38);
		$this->Cell(30,6,'Pendidikan',1,0,'C');
		$this->SetXY(244,38);
		$this->Cell(30,6,'Jenis Pekerjaan',1,0,'C');
	}
	public function kk_konten_satu_isi($nilai_y=0,$counter=0,$data=array()){
		$this->SetFont('Arial','',10);
		$no 		= (isset($data['no']))? $data['no'] : '';		
		$this->SetXY(17,$nilai_y);
		$this->Cell(15,6,$no,1,0,'C');

		$fullname	= (isset($data['nama_lengkap']))? $data['nama_lengkap'] : '';
		$this->SetXY(32,$nilai_y);
		$this->Cell(50,6,$fullname,1,0,'L');

		$nik 		= (isset($data['NIK']))? $data['NIK'] : '';
		$this->SetXY(82,$nilai_y);
		$this->Cell(30,6,$nik,1,0,'L');

		$gender 	= (isset($data['jenis_kelamin']))? GetGender($data['jenis_kelamin']) : '';
		$this->SetXY(112,$nilai_y);
		$this->Cell(16,6,$gender,1,0,'L');

		$birthplace= (isset($data['lahir_tempat']))? $data['lahir_tempat'] : '';
		$this->SetXY(128,$nilai_y);
		$this->Cell(40,6,$birthplace,1,0,'L');
		
		$birthdate	= (isset($data['lahir_tanggal']))? $data['lahir_tanggal'] : '';
		$this->SetXY(168,$nilai_y);
		$this->Cell(16,6,$birthdate,1,0,'L');
		
		$agama 		= (isset($data['agama']))? GetAgama($data['agama']) : '';
		$this->SetXY(184,$nilai_y);
		$this->Cell(30,6,$agama,1,0,'L');
		
		$edu		= (isset($data['pendidikan_terakhir']))? GetPendidikanTerakhir($data['pendidikan_terakhir']) : ''; 
			$this->SetXY(214,$nilai_y);
			$this->Cell(30,6,$edu,1,0,'L');

		$job 		='';
		if (isset($data['pekerjaan']) && !is_null($data['pekerjaan'])) {
			$pecah 	= explode('-', $data['pekerjaan']);
			$divisi	= GetKodeJob($pecah[0]);
			$job 	= $divisi[$pecah[1]];
		}
		$this->SetXY(244,$nilai_y);
		$this->Cell(30,6,$job,1,0,'L');
		
	}
 	
	public function kk_konten_isi_vertikal_loop($nilai_y=0,$counter=0,$exclude=array(),$func='kk_konten_satu_isi'){
		if (!is_null($this->data) && isset($this->data['anggota'])) {
			$data 		= array();
			$no 		= 1;
			foreach ($this->data['anggota'] as $key => $value) {
				foreach ($value as $k => $val) {
					if (in_array($k,$exclude)) {	
						$data[$k] = $val;
					}
					$data['no']	  = $no;
				}
				$this->$func($nilai_y,$counter,$data);
				$nilai_y+=$counter;
				$no++;
			}
		}
	}

	public function kk_konten_dua(){
		$this->SetFont('Arial','',10);

		$this->SetXY(17,108);
		$this->Cell(15,6,'No',1,0,'C');
		$this->SetXY(32,108);
		$this->Cell(50,6,'Status Pernikahan',1,0,'C');
		$this->SetXY(82,108);
		$this->Cell(50,6,'Status Hubungan Keluarga',1,0,'C');
		$this->SetXY(132,108);
		$this->Cell(35,6,'Kewarganegaraan',1,'C',0);
		$this->SetXY(167,108);
		$this->Cell(25,6,'No. Paspor',1,0,'C');
		$this->SetXY(192,108);
		$this->Cell(25,6,'No. Kitas/Kitap',1,'C',0);
		$this->SetXY(217,108);
		$this->Cell(29,6,'Ayah',1,0,'C');
		$this->SetXY(246,108);
		$this->Cell(28,6,'Ibu',1,0,'C');
			
	}
	public function kk_konten_dua_isi($nilai_y=0,$counter=0,$data=array()){
		$this->SetFont('Arial','',10);

		$no 			= (isset($data['no']))? $data['no'] : '';
		$this->SetXY(17,$nilai_y);
		$this->Cell(15,6,$no,1,0,'C');

		$status_keluarga = (isset($data['status_keluarga']))? get_status_kel($data['status_keluarga']) : '';
		$this->SetXY(32,$nilai_y);
		$this->Cell(50,6,$status_keluarga,1,0,'C');
		
		$status_perkawinan= (isset($data['status_perkawinan']))? get_sts_kawin($data['status_perkawinan']) : '';
		$this->SetXY(82,$nilai_y);
		$this->Cell(50,6,$status_perkawinan,1,0,'C');
		
		//
		$this->SetXY(132,$nilai_y);
		$this->Cell(35,6,'',1,0,'C');

		$this->SetXY(167,$nilai_y);
		$this->Cell(25,6,'',1,0,'C');

		$this->SetXY(192,$nilai_y);
		$this->Cell(25,6,'',1,0,'C');

		$this->SetXY(217,$nilai_y);
		$this->Cell(29,6,'',1,0,'C');

		$this->SetXY(246,$nilai_y);
		$this->Cell(28,6,'',1,0,'C');
	}

}