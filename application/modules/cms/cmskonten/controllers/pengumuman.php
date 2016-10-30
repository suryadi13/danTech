<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pengumuman extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_pengumuman');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('pengumuman');
		$this->load->view('pengumuman/index',$data);
	}
	function getdata(){
		$data['count'] = $this->m_konten->hitung_konten($_POST['cari'],$_POST['komponen'],$_POST['id_kat']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_konten->get_konten($_POST['cari'],$mulai,$batas,$_POST['komponen'],$_POST['id_kat']);
			foreach($data['hslquery'] as $it=>$val){
					$cek = Modules::run("cmshome/fotokonten",$val->id_konten);
					if(!empty($cek)){
						$data['hslquery'][$it]->cek="ada";
						$data['hslquery'][$it]->thumb="<img src='".base_url()."assets/media/foto/".$val->id_konten."/thumbs_".@$cek[0]->foto."' height=40 border=0>";
					}	else	{
						$data['hslquery'][$it]->cek="kosong";
						$data['hslquery'][$it]->thumb="<img src='".base_url()."assets/media/no_images.gif' height=40 border=0>";
					}
					$cek2 = Modules::run("cmshome/sliderkonten",$val->id_konten);
					if(!empty($cek2)){
						$data['hslquery'][$it]->cek2="ada";
						$data['hslquery'][$it]->slider="<img src='".base_url()."assets/media/slider/".$val->id_konten."/thumbs_".@$cek2[0]->foto."' height=40 border=0>";
					} else {
						$data['hslquery'][$it]->cek2="kosong";
						$data['hslquery'][$it]->slider="<img src='".base_url()."assets/media/no_slider.gif' height=40 border=0>";
					}
					$cek3 = Modules::run("cmshome/lampirankonten",$val->id_konten);
					if(!empty($cek3)){
						$data['hslquery'][$it]->cek3="ada";
						$data['hslquery'][$it]->lampiran="<img src='".base_url()."assets/media/any_attachment.gif' height=40 border=0>";
					} else {
						$data['hslquery'][$it]->cek3="kosong";
						$data['hslquery'][$it]->lampiran="<img src='".base_url()."assets/media/no_attachment.gif' height=40 border=0>";
					}
			}
			$data['pager'] = Modules::run("web/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}



	function formedit(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$data['label_aksi'] = ($_POST['id_konten']==0)?"Tambah":"Edit";
		$data['id_konten'] = $_POST['id_konten'];

		if($_POST['id_konten']==0){
			@$data['isi']->judul = "";
			@$data['isi']->sub_judul = "";
			@$data['isi']->id_kategori = "";
			@$data['isi']->komponen = "pengumuman";
			@$data['isi']->id_penulis = "";
			@$data['isi']->tanggal = "";
			@$data['isi']->isi_konten = "";
		} else {
			@$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		}

		$data['kategori_options'] =  Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,@$data['isi']->komponen);
		$data['penulis_options'] =  Modules::run("cmshome/penulis_options",@$data['isi']->id_penulis);
		$this->load->view('pengumuman/formedit',$data);
	}

	function formhapus(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$data['id_konten'] = $_POST['id_konten'];

		@$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['kategori_options'] =  Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,@$data['isi']->komponen);
		$data['penulis_options'] =  Modules::run("cmshome/penulis_options",@$data['isi']->id_penulis);

		$this->load->view('pengumuman/formhapus',$data);
	}

}
?>