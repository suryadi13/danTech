<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Galeri extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_galeri');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'1';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('galeri');
		$this->load->view('galeri/index',$data);
	}
	function formedit(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",$data['isi']->id_kategori,"galeri");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('galeri/formedit',$data);
	}
	function edit_aksi(){
 		$this->form_validation->set_rules("idd","IDD","trim|required|xss_clean");
 		$this->form_validation->set_rules("judul","Judul Berita Foto","trim|required|xss_clean");
        $this->form_validation->set_rules("id_kategori","Rubrik Berita Foto","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_buat","Tanggal Berita Foto","trim|required|xss_clean");
 		$this->form_validation->set_rules("keterangan","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_galeri->edit_galeri_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formtambah(){
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",$_POST['id_kat'],"galeri");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('galeri/formtambah',$data);
	}
	function tambah_aksi(){
 		$this->form_validation->set_rules("judul","Judul Berita Foto","trim|required|xss_clean");
        $this->form_validation->set_rules("id_kategori","Rubrik Berita Foto","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_buat","Tanggal Berita Foto","trim|required|xss_clean");
 		$this->form_validation->set_rules("keterangan","Keterangan","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_galeri->tambah_galeri_aksi($_POST)->id_konten; 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formhapus(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\" disabled>\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",$data['isi']->id_kategori,"galeri");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('galeri/formhapus',$data);
	}
	function hapus_aksi(){
		$this->m_galeri->hapus_galeri_aksi($_POST['idd']);
		echo "sukses#"."add#";
	}
////////////////////////////////////////////////////////////////////////////////
	function custom_kategori(){
		echo "";
	}

}
?>