<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Kanal extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	function index(){
		$data['ddr'] = $this->get_kanal_all(0);
		$data['default'] = Modules::run("cmshome/default_kanal");
		$this->load->view('kanal/index',$data);
	}
	public function detil_kanal(){
		$idk = $_POST['id_kanal'];
		$anak = $_POST['anak'];
		echo $this->detil_kanal_json($idk,$anak);
	}

	public function detil_kanal_json($id_kanal,$anak){
		$data['id_kanal'] = $id_kanal;
		$data['ini_kanal'] = $this->m_kanal->inikanal($id_kanal);
		$header = $this->m_kanal->get_header_kanal($id_kanal);
		$data['hapus_logo']=($header->nama_item=="")?"tidak":"ya";
		$data['logo']=($header->nama_item=="")?base_url()."assets/media/logo_kanal/".$this->m_kanal->getopsivalue('logo_app'):base_url()."assets/media/logo_kanal/".$id_kanal."/".$header->nama_item;
		$data['header'] = json_decode($header->meta_value);
		if($anak=="tidak"){
			$data['sub_kanal'] = $this->m_kanal->getkanal($id_kanal);
			foreach($data['sub_kanal'] as $it=>$val){
				$jj=json_decode($val->meta_value);
				$id=$data['sub_kanal'][$it]->id_kanal;
					$cek_rubrik=$this->m_kanal->cek_kanal_rubrik($id); // cek rubrik
					$cek_wrapper=$this->m_kanal->cek_kanal_wrapper($id); // cek wrapper
				$data['sub_kanal'][$it]->cek=(empty($cek_rubrik) && empty($cek_wrapper))?"kosong":"ada";
			}
		}
		$this->load->view('kanal/detil',$data);
	}


	public function formeditkanal(){
		$kanal=$this->m_kanal->ini_item($_POST['id_kanal']);
			$jj = json_decode($kanal[0]->meta_value);
		$data['id_kanal']=$_POST['id_kanal'];
		$data['nama_kanal']=$kanal[0]->nama_item;
		$data['keterangan']=$jj->keterangan;
		$data['path_root']=$jj->path_root;
		$data['tipe']=$jj->tipe;
		$data['level']=$_POST['idd'];
		$data['id_parent']=$_POST['pos'];
		$data['kanal_lama']=$jj->path_kanal;
			$tpl= Modules::run("cmshome/theme_options",$jj->theme);
			$data['theme']="<select id=theme name=theme  class='form-control'>".$tpl."</select>";

		$this->load->view('kanal/formedit_kanal',$data);
	}

	public function editkanal_aksi(){
        $this->form_validation->set_rules("nama_kanal","Nama Kanal","required");
		if($this->form_validation->run()) {
			$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
			$_POST['kanal_path'] = str_replace($d, '_',strtolower($_POST['nama_kanal']));
			$this->m_kanal->edit_aksi($_POST);
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}

	public function formhapuskanal(){
		$data['level']=$_POST['idd'];
		$data['id_parent']=$_POST['pos'];
		$data['kanal']=$this->m_kanal->inikanal($_POST['id_kanal']);
			$tpl= Modules::run("cmshome/theme_options",$data['kanal']->path_kanal);
			$data['theme']="<select id=theme name=theme  class='form-control' disabled>".$tpl."</select>";
		$this->load->view('kanal/formhapus_kanal',$data);
	}
	public function hapuskanal_aksi(){
			$this->m_kanal->hapus_kanal_aksi($_POST);
	}
	public function formtambahkanal(){
		$data['idparent']=$_POST['id_kanal'];
		$data['root']=$_POST['pos'];
		$data['level']=$_POST['idd'];

			$tpl= Modules::run("cmshome/theme_options");
			$data['theme']="<select id=theme name=theme  class='form-control'>".$tpl."</select>";
		$this->load->view('kanal/formtambah_kanal',$data);
	}
	public function tambahkanal_aksi(){
        $this->form_validation->set_rules("nama_kanal","Nama Kanal","required");
		if($this->form_validation->run()) {
		    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
			$_POST['kanal_path'] = str_replace($d, '_',strtolower($_POST['nama_kanal']));
			$this->m_kanal->tambah_aksi($_POST);
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}

	public function formeditheader(){
		$kanal=$this->m_kanal->ini_item($_POST['id_kanal']);
			$jj = json_decode($kanal[0]->meta_value);
		$data['id_kanal']=$_POST['id_kanal'];
		$data['nama_kanal']=$kanal[0]->nama_item;
		$header = $this->m_kanal->get_header_kanal($_POST['id_kanal']);
		$data['header'] = json_decode($header->meta_value);

		$this->load->view('kanal/formedit_header',$data);
	}
	public function editheader_aksi(){
		$this->m_kanal->edit_header_aksi($_POST);
	}
////////////////////////////////////////////////////////
//   NAIK / TURUN URUTAN ITEM
////////////////////////////////////////////////////////
	function urutitem(){
		$this->m_kanal->naik_index($_POST['id_ini'],$_POST['id_lawan'],$_POST['urutan_ini'],$_POST['urutan_lawan']);
	} 
	public function get_kanal_all($id_parent=0){
		$knl = array();
		$kanal = $this->m_kanal->getkanal($id_parent);
		foreach($kanal AS $key=>$val){
			$knl[$key] = $kanal[$key];

			$jj=json_decode($val->meta_value);
				$knl2 = $this->get_kanal_all($val->id_kanal);
				$cek_rubrik=$this->m_kanal->cek_kanal_rubrik($val->id_kanal); // cek rubrik
				$cek_wrapper=$this->m_kanal->cek_kanal_wrapper($val->id_kanal); // cek wrapper
			$knl[$key]->cek=(empty($cek_rubrik) && empty($cek_wrapper) && empty($knl2))?"kosong":"ada";
			$knl[$key]->path_kanal=$jj->path_kanal;

			foreach($knl2 AS $key2=>$val2){
				$knl[$key]->anak = $knl2;
			}
		}
		return $knl;
	}
	
}
?>