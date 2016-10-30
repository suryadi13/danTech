<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_direktori extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_direktori');
	}

	public function index($id_widget,$id_kat,$opsi)	{

		$data['opsi'] = $opsi;

		$this->load->view('index',$data);
	}

	public function getdaftar()	{
		$batas=$_POST['batas'];
		$hal=$_POST['hal'];
		$ini=$_POST['ini'];
		$id_wrapper=$_POST['id_wrapper'];
		$count = $_POST['count'];
		$data['mulai']=(($hal-1)*$batas)+1;
		
		$ddtt=$this->m_daftar->getwidget($id_wrapper,(($hal-1)*$batas),$batas);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');

		foreach($ddtt as $key=>$val){
			@$data['hslquery'][$key]->id_konten=$val->id_konten;
			$data['hslquery'][$key]->judul=$val->judul;
			$data['hslquery'][$key]->seo=str_replace($d, '-', $val->judul);
			$data['hslquery'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
		}

		$de = Modules::run("web/pagerA",$count,$batas,$hal,2);
		$data['pager']=$de;
		echo json_encode($data);
	}
}