<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_commented extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_commented');
	}

	public function index($nama_wrapper,$id_kat,$opsi)	{

		$kmk = $this->m_commented->getwidget($id_kat);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		foreach ($kmk['populer'] as $key=>$val) {
			@$data['populer'][$key]->id_konten = $val->id_konten;
			@$data['populer'][$key]->judul = $val->judul;
			@$data['populer'][$key]->tanggal = $val->tanggal;
			@$data['populer'][$key]->hari = $hh[$val->hari];
			@$data['populer'][$key]->seo = str_replace($d, '-', $val->judul);
			@$data['populer'][$key]->kat_seo = str_replace($d, '-', $val->nama_kategori);
		}
		foreach ($kmk['komentar'] as $key=>$val) {
			@$data['komentar'][$key]->id_konten = $val->id_konten;
			@$data['komentar'][$key]->judul = $val->judul;
			@$data['komentar'][$key]->tanggal = $val->tanggal;
			@$data['komentar'][$key]->hari = $hh[$val->hari];
			@$data['komentar'][$key]->seo = str_replace($d, '-', $val->judul);
			@$data['komentar'][$key]->kat_seo = str_replace($d, '-', $val->nama_kategori);
		}

		$data['margin_top']=$opsi[0]->nilai;
		$data['margin_bottom']=$opsi[1]->nilai;
		$this->load->view('index',$data);
	}

}