<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Banner extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_banner');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('banner');
		$this->load->view('banner/index',$data);
	}

	function getalbum(){
		$dt=$this->m_banner->hitung_album(); 
		if($dt['count']==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else {
			$batas=$_POST['batas'];
			if($_POST['hal']=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$_POST['hal'];	}
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
	
			$data['hslquery']=$this->m_banner->getalbum($mulai,$batas)->result();
			foreach($data['hslquery'] as $it=>$val){
				$idd=$data['hslquery'][$it]->id_kategori;
					$cek=$this->m_banner->isi_album($idd);
					if(!empty($cek)){
						$data['hslquery'][$it]->cek="ada";
						$data['hslquery'][$it]->thumb="<img src='".base_url().@$cek[0]->foto."' height=40 border=0>";
					}	else	{
						$data['hslquery'][$it]->cek="kosong";
						$data['hslquery'][$it]->thumb="<img src='".base_url()."assets/media/no_images.gif' height=40 border=0>";
					}
					$cek2=$this->m_banner->cek_wrapper($idd);
					if(empty($cek) && empty($cek2)){
						$data['hslquery'][$it]->hapus="ya";
					}	else	{
						$data['hslquery'][$it]->hapus="tidak";
					}
			}

			$data['pager'] = Modules::run("web/pagerC",$dt['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

	function formtambah(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('banner/formtambah',$data);
	}
	function tambah_aksi(){
 		$this->form_validation->set_rules("nama_kategori","Nama Album","trim|required|xss_clean");
 		$this->form_validation->set_rules("keterangan","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_banner->tambah_album_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}

	function formedit(){
		$idd=$_POST['id_konten'];
		$data['idd']=$idd;
		$data['hslquery']=$this->m_banner->inialbum($idd);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('banner/formedit',$data);
	}
	function edit_aksi(){
 		$this->form_validation->set_rules("nama_kategori","Nama Album","trim|required|xss_clean");
 		$this->form_validation->set_rules("keterangan","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_banner->edit_album_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formhapus(){
		$idd=$_POST['id_konten'];
		$data['idd']=$idd;
		$data['hslquery']=$this->m_banner->inialbum($idd);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('banner/formhapus',$data);
	}
	function hapus_aksi(){
		$ddir=$this->m_banner->hapus_album_aksi($_POST); 
		echo "sukses#"."add#";
	}
	function link_isi_aksi(){
		$this->m_banner->isi_link($_POST);
	}
	function link_hapus_aksi(){
		$this->m_banner->hapus_link($_POST);
	}


}
?>