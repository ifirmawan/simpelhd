<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends ThirdParty{
	function __construct(){
		require_once APPPATH.'/third_party/FPDF.php';
		parent::__construct(new FPDF());
	}
	function index(){
		$this->AddPage();
		$this->SetXY(17, 85); 
		$this->Cell(68,5,'Description of Goods',1,1,'C');
		$this->Output();
	}
}