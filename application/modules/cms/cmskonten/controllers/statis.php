<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Statis extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_konten');
	}
	
	function index(){
		$data['hal'] = (isset($_POST['hal']))?$_POST['hal']:'1';
		$data['batas'] = (isset($_POST['batas']))?$_POST['batas']:10;
		$data['cari'] = (isset($_POST['cari']))?$_POST['cari']:"";
		$data['id_kat'] = (isset($_POST['id_kat']))?$_POST['id_kat']:"";
		$data['komponen']=$this->m_konten->get_komponen();
		$data['kategori']=$this->m_konten->get_kategori('statis');
		$this->load->view('statis/index',$data);
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
			@$data['isi']->komponen = "artikel";
			@$data['isi']->id_penulis = "";
			@$data['isi']->tanggal = "";
			@$data['isi']->isi_konten = "";
		} else {
			@$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		}

		$data['kategori_options'] =  Modules::run("cmshome/kanal_options",0,@$data['isi']->id_kategori);
		$data['default_kanal'] =  Modules::run("cmshome/default_kanal");
		$data['penulis_options'] =  Modules::run("cmshome/penulis_options",@$data['isi']->id_penulis);

		$this->load->view('statis/formedit',$data);
	}

	function edit_aksi(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("judul","Judul","required");
        $this->form_validation->set_rules("tanggal","Tanggal","required");
        $this->form_validation->set_rules("id_kategori","Kanal","required");
 		$this->form_validation->set_rules("id_penulis","Penulis","required");
		$_POST['komponen'] = "statis";
		if($this->form_validation->run()) {
						if($this->input->post('id_konten') == 0):
							$this->m_konten->tambah_aksi($_POST);
						else:	
							$this->m_konten->edit_aksi($_POST);
						endif;
			$data['hasil'] = "sukses";
		 }else{
			$data['hasil'] = validation_errors();	
		 }
		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////////
	function formhapus(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['id_kat'] = $_POST['id_kat'];
		$data['id_konten'] = $_POST['id_konten'];

		@$data['isi'] = Modules::run("cmshome/detailkonten",$_POST['id_konten']);
		$data['kategori_options'] =  Modules::run("cmshome/kategori_options",@$data['isi']->id_kategori,@$data['isi']->komponen);
		$data['penulis_options'] =  Modules::run("cmshome/penulis_options",@$data['isi']->id_penulis);

		$this->load->view('statis/formhapus',$data);
	}
	function hapus_aksi(){
		$this->m_konten->hapus_aksi($_POST);
		$data['hasil'] = "sukses";
		echo json_encode($data);
	}
////////////////////////////////////////////////////////////////////////////////
	function custom_kategori(){
		echo "";
	}

}
?>