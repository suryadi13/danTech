<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Direktori extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
		$this->load->model('m_direktori');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'end';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('direktori');
		$this->load->view('direktori/index',$data);
	}
//////////////////////////////////////////////////////////////////////////////
	function formtambah(){
		$data = array( 'nama_kategori'=> 'Wajib diisi','nama_direktori'=> 'Wajib diisi');
				$dt=$this->m_direktori->detail_kategori($_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".$dt[0]->id_item."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		$data['pilrb']=$vv;
		$atr = json_decode($dt[0]->meta_value);
		$data['atribut'] = $this->m_direktori->getlabel(@$dt[0]->id_item);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('direktori/formtambah',$data);
	}
	function tambah_aksi(){
			$data['idd']=$_POST['id_kategori'];
			$this->form_validation->set_rules("nama_direktori","Nama Item Direktori","trim|required|xss_clean");
			$jml=count($this->input->post('id_atribut')); 
				for($i=0;$i<$jml;$i++){
						$this->form_validation->set_rules("isi_atribut[$i]","Atribut No.$i","trim|required|xss_clean");
				}	
				if($this->form_validation->run()) {
					$this->m_direktori->tambah_direktori_aksi($_POST);
					echo "sukses#"."add#";
				}
	}
	function formedit(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
	$ini=$this->m_direktori->inidirektori($_POST['id_konten']);
	$data['atr'] = json_decode($ini[0]->isi_konten);
	$data['ini']=$ini;
				$dt=$this->m_direktori->detail_kategori($_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".$dt[0]->id_item."'>
				<input type=hidden id='id_konten' name='id_konten' value='".$ini[0]->id_konten."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		$data['pilrb']=$vv;
		$data['atribut'] = $this->m_direktori->getlabel($dt[0]->id_item);


		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('direktori/formedit',$data);
	}
	function edit_aksi(){
			$data['idd']=$_POST['id_kategori'];
			$this->form_validation->set_rules("nama_direktori","Nama Item Direktori","trim|required|xss_clean");
			$jml=count($this->input->post('id_atribut')); 
				for($i=0;$i<$jml;$i++){
						$this->form_validation->set_rules("isi_atribut[$i]","Atribut No.$i","trim|required|xss_clean");
				}	
				if($this->form_validation->run()) {
					$this->m_direktori->edit_direktori_aksi($_POST);
					echo "sukses#"."add#";
				}
	}
	function formhapus(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
	$ini=$this->m_direktori->inidirektori($_POST['id_konten']);
	$data['atr'] = json_decode($ini[0]->isi_konten);
	$data['ini']=$ini;
				$dt=$this->m_direktori->detail_kategori($_POST['id_kat']);
				$vv="<input type=hidden id='id_kategori' name='id_kategori' value='".$dt[0]->id_item."'>
				<input type=hidden id='id_konten' name='id_konten' value='".$ini[0]->id_konten."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		$data['pilrb']=$vv;
		$data['atribut'] = $this->m_direktori->getlabel($dt[0]->id_item);


		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$this->load->view('direktori/formhapus',$data);
	}
	function hapus_aksi(){
					$this->m_direktori->hapus_direktori_aksi($_POST);
					echo "sukses#"."add#";
	}
//////////////////////////////////////////////////////////////////////////////
	function edit_kategori_aksi($isi){
		$this->m_direktori->edit_kategori_aksi($isi);
		echo "sukses#"."add#";
	}
	function tambah_kategori_aksi($isi){
		$this->m_direktori->tambah_kategori_aksi($_POST);
		echo "sukses#"."add#";
	}
	function hapus_kategori_aksi($idp,$idk){
		$this->m_direktori->hapus_kategori_aksi($idp,$idk);
	}
	function tambah_atribut_aksi(){
		$this->m_direktori->tambah_atribut_aksi($_POST);
		echo "bagus";
	}
	function hapus_atribut_aksi(){
		$this->m_direktori->hapus_atribut_aksi($_POST);
		echo "bagus";
	}
//////////////////////////////////////////////////////////////////////////////
	function custom_kategori(){
		if($_POST['custom']=="edit"){
			$dt=$this->m_konten->detail_kategori($_POST['idd']);
			$data['idd'] = $_POST['idd'];
			$data['jj'] = $this->m_konten->getlabel($_POST['idd']);
			$this->load->view('direktori/formcustom_edit',$data);
		} elseif ($_POST['custom']=="hapus"){
			$dt=$this->m_konten->detail_kategori($_POST['idd']);
			$data['idd'] = $_POST['idd'];
			$data['jj'] = $this->m_konten->getlabel($_POST['idd']);
			$this->load->view('direktori/formcustom_hapus',$data);
		} else {
			$data['satu']="Satu...";
			$this->load->view('direktori/formcustom_tambah',$data);
		}
	}
	function reurut_atribut(){
		$this->m_konten->reurut_atribut_aksi($_POST);
		echo "success";
	}
//////////////////////////////////////////////////////////////////////////////

}
?>