<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_daftar extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_daftar');
	}

	public function index($id_widget,$id_kat,$opsi,$nno)	{

		$data['nama_wrapper'] = $id_widget;

	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$data['jdl'] = str_replace($d, '-', $data['nama_wrapper']);
		$data['id_kat'] = $id_kat;
		$data['idx'] = $nno;


		$ddtt = $this->m_daftar->getwidget($id_kat,0,$opsi[2]->nilai);

	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		foreach($ddtt as $key=>$val){
			@$data['hslquery'][$key]->id_konten=$val->id_konten;
			$data['hslquery'][$key]->judul=$val->judul;
			$data['hslquery'][$key]->seo=str_replace($d, '-', $val->judul);
			$data['hslquery'][$key]->katseo=str_replace($d, '-', $val->nama_kategori);
		}
		$data['margin_top']=$opsi[0]->nilai;
		$dk = $this->m_daftar->hitung_item($ddtt[0]->id_kategori);

		$data['count'] = $dk['count'];
		$data['batas']=$opsi[2]->nilai;
		$data['ini'] = $id_widget;
		$data['pager'] = Modules::run("web/pagerA",$dk['count'],$data['batas'],1,2);
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