<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Agenda extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_agenda');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'1';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('agenda');
		$this->load->view('agenda/index',$data);
	}
	function formtambah(){
		$data = array( 'tema'=> 'Wajib diisi','tgl_mulai'=> 'Wajib diisi','tgl_selesai'=> 'Wajib diisi', 'tempat'=> 'Wajib diisi', 'isi_agenda'=> 'Wajib diisi');
		if($_POST['id_kat']==""){
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options","","agenda");
				$vv = $vv."</select>\n";

		} else {
				$dt = Modules::run("cmshome/detailrubrik",$_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".@$dt[0]->id_item."'>";
				$vv=$vv."<b>".@$dt[0]->nama_item."</b>";
		}
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('agenda/formtambah',$data);
	}
	function tambah_aksi(){
 		$this->form_validation->set_rules("tema","Judul Agenda","trim|required|xss_clean");
        $this->form_validation->set_rules("id_kategori","Rubrik Agenda","trim|required|xss_clean");
 		$this->form_validation->set_rules("tempat","Tempat","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_mulai","Tanggal Mulai","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_selesai","Tanggal Selesai","trim|required|xss_clean");
 		$this->form_validation->set_rules("isi_agenda","Isi Agenda","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$ddir=$this->m_agenda->tambah_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formedit(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['detil'] = json_decode($data['isi']->isi_konten);
		$data['pilrb']=Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,"agenda");
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('agenda/formedit',$data);
	}
	function edit_aksi(){
 		$this->form_validation->set_rules("judul","Judul Agenda","trim|required|xss_clean");
        $this->form_validation->set_rules("id_kategori","Rubrik Agenda","trim|required|xss_clean");
 		$this->form_validation->set_rules("sub_judul","Tempat","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_mulai","Tanggal Mulai","trim|required|xss_clean");
 		$this->form_validation->set_rules("tgl_selesai","Tanggal Selesai","trim|required|xss_clean");
 		$this->form_validation->set_rules("isi_agenda","Isi Agenda","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_agenda->edit_aksi($_POST); 
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}

	function formhapus(){
		$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['detil'] = json_decode($data['isi']->isi_konten);
		$data['pilrb']=Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,"agenda");
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('agenda/formhapus',$data);
	}
	function hapus_aksi(){
		$idd=$_POST['idd'];
		$this->m_agenda->hapus_aksi($idd);
		echo "sukses#"."add#";
	}
///////////////////////////RUBRIK HANDLING//////////////////////////
	function custom_kategori(){
		echo "";
	}

}
?>