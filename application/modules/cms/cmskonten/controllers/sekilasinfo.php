<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sekilasinfo extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_sekilasinfo');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('sekilasinfo');
		$this->load->view('sekilasinfo/index',$data);
	}

	function getkonten(){
		$idKat = ($_POST['id_kat']=="")?"xx":$_POST['id_kat'];
		$dt = $this->m_konten->hitung_sekilasinfo($idKat,$_POST['komponen']); 
		if($dt['count']==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else { 
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;

			$data['hslquery'] = $this->m_konten->get_sekilasinfo($mulai,$batas,$idKat,$_POST['komponen'])->result();
			$data['pager'] = Modules::run("web/pagerC",$dt['count'],$batas,$hal);
		}
/*
			if($_POST['rubrik']=="xx"){
				$data['tb_hapus'] = "<div id=\"bt_hapus_rubrik\"></div>";
			} else {
				$tg = $this->m_sekilasinfo->cek_wrapper($_POST['rubrik']);
				if(empty($tg) && $dt['count']==0){
					$data['tb_hapus'] = "<button id='bt_hapus_rubrik' class='tombol_aksi' onclick=\"loadForm('formhapus_kategori','xx');\">Hapus Rubrik ini</button>";
				} else {
					$data['tb_hapus'] = "<div id=\"bt_hapus_rubrik\"></div>";
				}
			}

*/
			echo json_encode($data);
	}
	function formtambah(){
		$data = array( 'tema'=> 'Wajib diisi','tgl_mulai'=> 'Wajib diisi','tgl_selesai'=> 'Wajib diisi', 'tempat'=> 'Wajib diisi', 'isi_agenda'=> 'Wajib diisi');
		if($_POST['id_kat']==""){
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"form-control\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options","","sekilasinfo");
				$vv = $vv."</select>\n";

		} else {
				$dt = Modules::run("cmshome/detailrubrik",$_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".$dt[0]->id_item."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		}
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('sekilasinfo/formtambah',$data);
	}
	function tambah_aksi(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("judul","Judul Sekilas Info","trim|required|xss_clean");
        $this->form_validation->set_rules("isi","Isi Sekilas Info","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_sekilasinfo->tambah_aksi($_POST);
			echo "sukses#kjkj";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formedit(){
		$data['isi'] = $this->m_sekilasinfo->detailkonten($_POST['id_konten']);
				$vv = "\n<select id='id_kategori' name='id_kategori' class=\"ipt_text\" style=\"width:200px;\">\n<option value=''>-- Pilih --</option>\n";
				$vv = $vv.Modules::run("cmshome/kategori_options",@$data['isi'][0]->id_konten,"sekilasinfo");
				$vv = $vv."</select>\n";
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('sekilasinfo/formedit',$data);
	}
	function edit_aksi(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("judul","Judul Sekilas Info","trim|required|xss_clean");
        $this->form_validation->set_rules("isi","Isi Sekilas Info","trim|required|xss_clean");
		if($this->form_validation->run()) {
			$this->m_sekilasinfo->edit_aksi($_POST);
			echo "sukses#kjkj";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
	function formhapus(){
		$data['isi'] = $this->m_sekilasinfo->detailkonten($_POST['id_konten']);
				$dt = Modules::run("cmshome/detailrubrik",@$data['isi'][0]->id_konten);
				$vv="<b>".@$dt[0]->nama_item."</b>";
		$data['pilrb']=$vv;
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('sekilasinfo/formhapus',$data);
	}
	function hapus_aksi(){
			$this->m_sekilasinfo->hapus_aksi($_POST);
			echo "sukses#kjkj";
	}
////////////////////////////////////////////////////////////////////////////////
	function custom_kategori(){
		echo "";
	}
}
?>