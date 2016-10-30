<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komentar extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_element');
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function index($id_konten)	{
		$data['id_konten'] = $id_konten;
			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/element/komentar.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/element/';
				$this->load->view($this->viewPath.'komentar',$data);
			} else {
				$this->load->view('komentar',$data);
			}
	}
	public function getkomen()	{
		$batas=$_POST['batas'];
		$dt=$this->m_element->hitung_komen($_POST['idd']); 

		if($_POST['hal']=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$_POST['hal'];	}
		$mulai=($hal-1)*$batas;
		$data['mulai']=$mulai+1;

		$data['hslquery']=$this->m_element->getkomen($mulai,$batas,$_POST['idd']);

			foreach($data['hslquery'] as $it=>$val){
					$jawaban = $this->m_element->ini_jawaban($val->id_komentar);
					@$data['hslquery'][$it]->jawab = (!empty($jawaban))?"ada":"tidak";
					@$data['hslquery'][$it]->jawaban = (!empty($jawaban))?$jawaban->isi_komentar:"...";
					@$data['hslquery'][$it]->tanggal_jawaban = (!empty($jawaban))?$jawaban->tanggal_komentar:"...";
			}


		$data['pager']= ($dt['count']>0)?Modules::run("web/pagerA",$dt['count'],$batas,$hal,5):"...";
		echo json_encode($data);
	}
	public function savekomentar()	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("nama_komentator","NAMA","trim|required|xss_clean");
		$this->form_validation->set_rules("email_komentator","EMAIL","trim|required|xss_clean");
        $this->form_validation->set_rules("isi_komentar","KOMENTAR","trim|required|xss_clean");
		$hw = $this->input->ip_address();
		$blk = "188.143.232.";

		if($this->form_validation->run()) {
			if(!strpos($hw,$blk)) {
				$this->m_element->isi_komentar_aksi($_POST,$hw);
			}
			echo "sukses#kjkj";
		 }else{
			echo "error-".validation_errors()."#0";	
		 }
	}
}