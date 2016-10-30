<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_artikel_lastten extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_artikel_lastten');
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['daftar'] = $this->m_artikel_lastten->getwidget($id_widget,$id_wrapper,$opsi[2]->nilai);
		$data['nama_wrapper'] = $id_widget;
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		foreach ($data['daftar'] as $key=>$val) {
			@$data['daftar'][$key]->hari = $hh[$val->hari];
			@$data['daftar'][$key]->seo = str_replace($d, '-', $val->judul);
			@$data['daftar'][$key]->kat_seo = str_replace($d, '-', $val->nama_kategori);
			$fr=$val->isi_konten;
			$df=explode("\n",$fr);
			@$data['daftar'][$key]->sub=$df[0];
			$gambar=$this->m_artikel_lastten->gambar_artikel($val->id_konten);
			@$data['daftar'][$key]->thumb = (!empty($gambar))?$gambar[0]->foto:"assets/media/no_images.gif" ;
		}
		$data['margin_top']=$opsi[0]->nilai;
		$data['margin_bottom']=$opsi[1]->nilai;
		$data['banyaknya'] = $opsi[2]->nilai;

				$sess = $this->session->userdata('visit');
				$path='assets/themes/'.$sess['theme'].'/widget/artikel_lastten.php';
				if(file_exists($path)){	
					$this->viewPath = '../../assets/themes/'.$sess['theme'].'/widget/';
					$this->load->view($this->viewPath.'artikel_lastten',$data);
				} else {
					$this->load->view('index',$data);
				}
	}

}