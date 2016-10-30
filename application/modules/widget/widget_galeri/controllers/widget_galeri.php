<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_galeri extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_widget_galeri');
	}

	public function index($nama_wrapper,$id_kat,$opsi)	{
		$data['nama_wrapper'] = $nama_wrapper;
		$data['daftar'] = $this->m_widget_galeri->getwidget($id_kat);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";

		foreach($data['daftar'] as $key=>$val){
			$data['daftar'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
			$data['daftar'][$key]->seo=str_replace($d, '-', $val->judul);
		}

		$data['margin_top']=$opsi[0]->nilai;

		$this->load->view('index',$data);
	}

}