<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Kategori extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	public function index(){
		$data['id_kanal'] = $_POST['id_kanal'];
		$data['kategori'] = $this->m_kanal->inikanalkategori($_POST['id_kanal']);
		foreach($data['kategori'] AS $key=>$val){
			$cek_konten = $this->m_kanal->kontenkategori($val->id_kategori);
			$cek_kategori_widget = $this->m_kanal->widgetkategori($val->id_kategori,$val->komponen);
			$data['kategori'][$key]->cek = (empty($cek_konten) && empty($cek_kategori_widget))?"kosong":"tidak";
		}
		$this->load->view('kategori/index',$data);
	}
	public function formtambahkategori(){
		$data['idd'] = $_POST['idd'];
		$data['id_kanal'] = $_POST['id_kanal'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$kanalini=$this->m_kanal->ini_item($_POST['id_kanal']);
		$data['kanal'] = ($_POST['id_kanal']=="")?"Default":@$kanalini[0]->nama_item;

		$tpl_1= Modules::run("cmshome/paging_kategori_options",5);
		$data['pg_index']="<select id='paging_index' name='paging_index'  class='form-control'>".$tpl_1."</select>";
		$tpl_2= Modules::run("cmshome/paging_kategori_options",5);
		$data['pg_arsip']="<select id='paging_arsip' name='paging_arsip'  class='form-control'>".$tpl_2."</select>";

			$kpn= Modules::run("cmshome/komponen_options","ya","");
			$data['komponen']="<select id=komponen onChange=\"lanjut();\" name=komponen class='form-control ipt_text' style=\"width:200px;\">".$kpn."</select>";
		$this->load->view('kategori/formtambahkategori',$data);
	}
	public function tambahkategori_aksi(){
		if(isset($_POST['custom'])){
			echo Modules::run("cmskonten/".$_POST['custom']."/tambah_kategori_aksi",$_POST);
		} else {
			$this->m_kanal->tambah_kategori_aksi($_POST);
			echo "sukses#"."add#";
		}
	}
	function formeditkategori($fix="ya"){
		$data['idd'] = $_POST['idd'];
		$data['id_kanal'] = $_POST['id_kanal'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$kanalini=$this->m_kanal->ini_item($_POST['id_kanal']);
		$data['kanal'] = ($_POST['id_kanal']=="")?"Default":@$kanalini[0]->nama_item;
		$kategori = $this->m_kanal->ini_item($_POST['idd']);
			$jj = json_decode(@$kategori[0]->meta_value);
		$data['nama_kategori']=@$kategori[0]->nama_item;
		$data['keterangan']=$jj->keterangan;
		
		$pgr_index = (isset($jj->paging_index))?$jj->paging_index:2;
		$pgr_arsip = (isset($jj->paging_arsip))?$jj->paging_arsip:2;

		$tpl_1= Modules::run("cmshome/paging_kategori_options",$pgr_index);
		$data['pg_index']="<select id='paging_index' name='paging_index'  class='form-control'>".$tpl_1."</select>";
		$tpl_2= Modules::run("cmshome/paging_kategori_options",$pgr_arsip);
		$data['pg_arsip']="<select id='paging_arsip' name='paging_arsip'  class='form-control'>".$tpl_2."</select>";

		$data['komponen']="<input type=hidden name=komponen id=komponen value='".$jj->komponen."'><div class='ipt_text' style=\"width:200px;\"><b>".$jj->komponen."</b></div>";

		$this->load->view('kategori/formeditkategori',$data);
	}
	function editkategori_aksi(){
		if(isset($_POST['custom'])){
			echo Modules::run("cmskonten/".$_POST['custom']."/edit_kategori_aksi",$_POST);
		} else {
			$this->m_kanal->edit_kategori_aksi($_POST);
			echo "sukses#"."add#";
		}
	}
	public function formhapuskategori(){
		$data['idd'] = $_POST['idd'];
		$data['id_kanal'] = $_POST['id_kanal'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$kanalini=$this->m_kanal->ini_item($_POST['id_kanal']);
		$data['kanal'] = ($_POST['id_kanal']=="")?"Default":@$kanalini[0]->nama_item;
		$kat = $this->m_kanal->ini_item($_POST['idd']);
			$jj = json_decode($kat[0]->meta_value);
		$data['nama_kategori'] = $kat[0]->nama_item;
		$data['komponen'] = $jj->komponen;
		$data['keterangan'] = $jj->keterangan;
		$this->load->view('kategori/formhapuskategori',$data);
	}
	public function hapuskategori_aksi(){
		if(isset($_POST['custom'])){
			Modules::run("cmskonten/".$_POST['custom']."/hapus_kategori_aksi",$_POST['idd'],$_POST['id_kanal']);
		} else {
			$this->m_kanal->hapus_kategori_aksi($_POST['idd'],$_POST['id_kanal']);
		}
		echo "sukses#"."add#";
	}
	function formpindahkategori(){
		$data['idd'] = $_POST['idd'];
		$data['id_kanal'] = $_POST['id_kanal'];

		$data['kanal'] =  Modules::run("cmshome/kanal_options",0,$_POST['id_kanal']);
		$data['default_kanal'] =  Modules::run("cmshome/default_kanal");

		$kategori = $this->m_kanal->ini_item($_POST['idd']);
			$jj = json_decode(@$kategori[0]->meta_value);
		$data['nama_kategori']=@$kategori[0]->nama_item;
		$data['keterangan']=$jj->keterangan;
					$data['komponen']="<input type=hidden name=komponen id=komponen value='".$jj->komponen."'><div class='ipt_text' style=\"width:200px;\"><b>".$jj->komponen."</b></div>";

		$this->load->view('kategori/formpindahkategori',$data);
	}
	public function pindahkategori_aksi(){
		$this->m_kanal->pindah_kategori_aksi($_POST['idd'],$_POST['idd_kanal'],$_POST['kanal_baru']);
		echo "sukses#"."add#";
	}
////////////////////////////////////////////////////////////////////
/////Memproses naik urutan menu
////////////////////////////////////////////////////////////////////
	function naik_aksi(){
		$id_ini=$_POST['id_ini'];
		$id_lawan=$_POST['id_lawan'];
		$urutan_ini=$_POST['urutan_ini'];
		$urutan_lawan=$_POST['urutan_lawan'];
		$this->m_kanal->naik_index($id_ini,$id_lawan,$urutan_ini,$urutan_lawan);
	}

}
?>