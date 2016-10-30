<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_pengumuman_samping extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_pengumuman_samping');
	}

	public function index($nama_wrapper,$id_kat,$opsi)	{

		$data['daftar'] = $this->m_pengumuman_samping->getwidget($id_kat,$opsi[2]->nilai);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		foreach ($data['daftar'] as $key=>$val) {
			@$data['daftar'][$key]->hari = $hh[$val->hari];
			@$data['daftar'][$key]->seo = str_replace($d, '-', $val->judul);
			@$data['daftar'][$key]->kat_seo = str_replace($d, '-', $val->nama_kategori);
		}

		$data['kat']=$opsi[2]->nilai;
		$data['nama_wii']=$nama_wrapper;
		$data['margin_top']=$opsi[0]->nilai;
		$this->load->view('index',$data);
	}

}