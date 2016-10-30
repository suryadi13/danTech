<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_polling_samping extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_polling_samping');
	}
///////////////////////////////////////////////////////////////////////////
	public function index($nama_wrapper,$id_kat,$opsi)	{
		$data['nama_wrapper'] = $nama_wrapper;
		$ddtt = $this->m_polling_samping->getwidget($id_kat,$opsi[2]->nilai);
		$data['ttt']=$opsi[2]->nilai;

	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		foreach($ddtt as $key=>$val){
			@$data['hslquery'][$key]->id_konten = $val->id_konten;
			$data['hslquery'][$key]->judul = $val->judul;
			$data['hslquery'][$key]->seo = str_replace($d, '-', $val->judul);
			$data['hslquery'][$key]->katseo = str_replace($d, '-', $val->nama_kategori);
			$data['hslquery'][$key]->pil = $this->m_polling_samping->getpilihanpolling($val->id_konten);
		}
		$data['margin_top']=$opsi[0]->nilai;
		$this->load->view('index',$data);
	}

}