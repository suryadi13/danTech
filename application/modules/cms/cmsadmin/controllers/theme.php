<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Theme extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_theme');
	}

	function index(){
		$data['isi'] = $this->m_theme->gettheme();
		foreach($data['isi'] AS $key=>$val){
			$jj = json_decode($val->meta_value);
			$data['isi'][$key]->keterangan = @$jj->keterangan;
			$cek = $this->m_theme->cek_theme($jj->theme_path);
			$data['isi'][$key]->cek = (empty($cek))?"kosong":"ada";
		}
		$this->load->view('theme/index',$data);
	}
	function formtambah(){
		$data['aksi'] = "tambah";
		$this->load->view('theme/formtheme',$data);
	}
	function formedit(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "edit";
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$data['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		@$data['isi']->nama_theme = $isi->nama_item;
		$data['isi']->keterangan = $jj->keterangan;
		$this->load->view('theme/formtheme',$data);
	}
	function formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$data['hapus'] = "ya";
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$data['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		@$data['isi']->nama_theme = $isi->nama_item;
		$data['isi']->keterangan = $jj->keterangan;
		$this->load->view('theme/formtheme',$data);
	}
	function tambah_aksi(){
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$_POST['theme_path'] = str_replace($d, '',strtolower($_POST['theme_name']));
		$this->m_theme->admin_tambah_aksi($_POST,4);
	}
	function edit_aksi(){
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$_POST['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		$_POST['theme_path'] = $jj->theme_path;
		$this->m_theme->edit_aksi($_POST);
		echo "sukses";
	}
	function hapus_aksi(){
		$this->m_theme->hapus_item_aksi($_POST['idd'],4);
		echo "sukses";
	}

	function admin(){
		$data['isi'] = $this->m_theme->getadminpanel();
		foreach($data['isi'] AS $key=>$val){
			$jj = json_decode($val->meta_value);
			$cek = $this->m_theme->cek_admin($jj->theme_path);
			$data['isi'][$key]->keterangan = @$jj->keterangan;
			$data['isi'][$key]->cek = (empty($cek))?"kosong":"ada";
		}
		$this->load->view('theme/admin',$data);
	}
	function admin_formtambah(){
		$data['aksi'] = "tambah";
		$this->load->view('theme/formadmin',$data);
	}
	function admin_formedit(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "edit";
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$data['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		@$data['isi']->nama_theme = $isi->nama_item;
		$data['isi']->keterangan = $jj->keterangan;
		$this->load->view('theme/formadmin',$data);
	}
	function admin_formhapus(){
		$data['idd'] = $_POST['idd'];
		$data['aksi'] = "hapus";
		$data['hapus'] = "ya";
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$data['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		@$data['isi']->nama_theme = $isi->nama_item;
		$data['isi']->keterangan = $jj->keterangan;
		$this->load->view('theme/formadmin',$data);
	}
	function admin_tambah_aksi(){
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$_POST['theme_path'] = str_replace($d, '',strtolower($_POST['theme_name']));
		$this->m_theme->admin_tambah_aksi($_POST,3);
		echo "sukses";
	}
	function admin_edit_aksi(){
		$sq = "SELECT * FROM cmf_setting WHERE id_item='".$_POST['idd']."'";
		$isi = $this->db->query($sq)->row();
		$jj = json_decode($isi->meta_value);
		$_POST['theme_path'] = $jj->theme_path;
		$this->m_theme->admin_edit_aksi($_POST);
		echo "sukses";
	}
	function admin_hapus_aksi(){
		$this->m_theme->hapus_item_aksi($_POST['idd'],3);
		echo "sukses";
	}
}
?>