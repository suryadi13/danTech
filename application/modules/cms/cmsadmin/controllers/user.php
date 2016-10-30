<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}
///////////////////////////////////////////////////////////////////////////////////
  function pilihan_alertafter($asRef=false)  {
    if(!$asRef){	$select ['60000'] = 'Pilih waktu jeda';	}else{	$select [''] = '-';	}
    $select ['60000'] = '1 menit';
    $select ['120000'] = '2 menit';
    $select ['300000'] = '5 menit';
    $select ['600000'] = '10 menit';

    return $select;
  }
  function pilihan_logoutafter($asRef=false)  {
    if(!$asRef){	$select ['30000'] = 'Pilih waktu logout';	}else{	$select [''] = '-';	}
    $select ['30000'] = '30 detik';
    $select ['60000'] = '1 menit';
    $select ['120000'] = '2 menit';
    $select ['300000'] = '5 menit';
    $select ['600000'] = '10 menit';

    return $select;
  }
///////////////////////////////////////////////////////////////////////////////////

	function index(){
        $data["hal"] = (isset($_POST["hal"]))?$_POST["hal"]:"end";
        $data["batas"] = (isset($_POST["batas"]))?$_POST["batas"]:10;
        $data["cari"] = (isset($_POST["cari"]))?$_POST["cari"]:"";
		$grup = Modules::run("cmsadmin/user/getusergroup");
		$data['grup'] = json_decode($grup);
		$this->load->view('user/index',$data);
	}

	function dropdowns_grup_pengguna($idd=false){
			$select=array();
			if(!$idd){	$select [0] = 'Pilih...';	} else {	$select [0] = '-';	}
			
			foreach($grup AS $key=>$val){
				$select[$val->group_id] = $val->group_id;
				$select[$val->group_name] = $val->group_name;
			}
	    return $select;
	}


	function getuser(){
		$batas=$_POST['batas'];
		$grup=$_POST['grup'];
		if($grup!="xx"){ $path=$grup; } else { $path="xx"; }
		$dt=$this->m_user->hitung_user($path); 

		if($dt['count']==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else { 

			if($_POST['hal']=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$_POST['hal'];	}
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
	
			$data['hslquery']=$this->m_user->getuser($mulai,$batas,$path)->result();
			foreach($data['hslquery'] as $it=>$val){
				$id=$data['hslquery'][$it]->user_id;
					$cek=$this->m_user->cek_user($id,$data['hslquery'][$it]->group_name);
					if(!empty($cek)){$data['hslquery'][$it]->cek="ada";}	else	{$data['hslquery'][$it]->cek="kosong";}
			}
			$data['pager'] = Modules::run("web/pagerC",$dt['count'],$batas,$hal);
		}
		echo json_encode($data);
	}

///////////////////////////////////////////////////////////////////////////////
	function formtambah(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		if($_POST['grup']=="xx"){
				$dt=$this->m_user->getusergroup();
				$vv="\n<select id='group_id' name='gorup_id' class='form-control ipt_text'>\n<option value=''>-- Pilih --</option>\n";
				foreach($dt as $it=>$val){	$vv=$vv."<option value='".$val->group_id."'>".$val->group_name."</option>\n";	}
				$vv=$vv."</select>\n";
		} else {
				$dt=$this->m_user->detail_grup($_POST['grup'])->result();
				$vv="<input type=hidden id='group_id' name='group_id' value='".$dt[0]->id_item."'>";
				$vv=$vv."<b>".$dt[0]->nama_item."</b>";
		}
		$data['pilgr']=$vv;
		$this->load->view('user/formtambah_user',$data);
	}
	function tambah_aksi(){
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nm_pengguna']=$ang[0];
			$ipp['user_name']=$ang[1];
			$ipp['group_id']=$ang[2];
		$proses = $this->m_user->tambah_user_aksi($ipp);
		echo $proses;
	}
	function formedit(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$data['user_id']=$_POST['user_id'];

		$data['hslquery']=$this->m_user->detail_user($_POST['user_id']);
		$data['hslqueryb']=$this->m_user->getusergroup();
		$this->load->view('user/formedit_user',$data);
	}
	function edit_aksi(){
		$idd=$_POST['user_id'];
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nm_pengguna']=$ang[0];
			$ipp['user_name']=$ang[1];
			$ipp['group_id']=$ang[2];
		$proses = $this->m_user->edit_user_aksi($idd,$ipp);
		echo $proses;
	}
	function formhapus(){
		$data['user_id']=$_POST['user_id'];
		$data['hslquery']=$this->m_user->detail_user($_POST['user_id']);
		$data['hslqueryb']=$this->m_user->getusergroup();
		$this->load->view('user/formhapus_user',$data);
	}
	function hapus_aksi(){
		$idd=$_POST['user_id'];
		$this->m_user->hapus_user_aksi($idd);
	}
///////////////////////////////////////////////////////////////////////////////
	function grup(){
		$data['default']="amin";
		$this->load->view('user/grup',$data);
	}
	function getusergroup(){
		$data['hslquery']=$this->m_user->getusergroup();
		$pil_alertafter = $this->pilihan_alertafter();
		$pil_logoutafter = $this->pilihan_logoutafter();
		foreach($data['hslquery'] as $it=>$val){
			$jj = json_decode($val->meta_value);

			$data['hslquery'][$it]->section_name=$jj->section_name;
			$data['hslquery'][$it]->back_office=$jj->back_office;
			$data['hslquery'][$it]->keterangan=$jj->keterangan;
			$data['hslquery'][$it]->judul_app=$jj->judul_app;
			$data['hslquery'][$it]->sub_judul=$jj->sub_judul;
			$data['hslquery'][$it]->alertafter=@$pil_alertafter[$jj->alertafter];
			$data['hslquery'][$it]->logoutafter=@$pil_logoutafter[$jj->logoutafter];
			$cek=$this->m_user->cek_grup($val->group_id)->result();
			$data['hslquery'][$it]->cek=(!empty($cek))?"ada":"kosong";
		}
		echo json_encode($data['hslquery']);
	}
	function formtambahgroup(){
			$tpl= Modules::run("cmshome/theme_admin_options");
			$data['theme']="<select id='nama_section' name='nama_section'  class='form-control'>".$tpl."</select>";
			$data['judul_app'] = $this->m_user->getopsivalue('nama_app');
			$data['sub_judul'] = $this->m_user->getopsivalue('slogan_app');
			$data['pil_alertafter'] = $this->pilihan_alertafter();
			$data['pil_logoutafter'] = $this->pilihan_logoutafter();

		$this->load->view('user/formtambah_group',$data);
	}
	function tambah_group_aksi(){
        $this->form_validation->set_rules("nama_section","Nama Section","required");
		if($this->form_validation->run()) {
			$this->m_user->tambah_grup_aksi($_POST);
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
////////////////////////////////////////////////////////////////////
	function formeditgroup(){
		$data['group_id']=$_POST['group_id'];
		$hslquery=$this->m_user->detail_grup($_POST['group_id'])->result();
			$jj = json_decode($hslquery[0]->meta_value);
		$data['group_name']=$hslquery[0]->nama_item;
		$data['judul_app']=$jj->judul_app;
		$data['sub_judul']=$jj->sub_judul;
		$data['pil_alertafter'] = $this->pilihan_alertafter();
		$data['pil_logoutafter'] = $this->pilihan_logoutafter();

		$data['section_name']=$jj->section_name;
			$tpl= Modules::run("cmshome/theme_admin_options",$jj->section_name);
			$data['theme']="<select id='nama_section' name='nama_section'  class='form-control'>".$tpl."</select>";
		$data['backoffice']=$jj->back_office;
		$data['keterangan']=$jj->keterangan;
		$data['alertafter']=@$jj->alertafter;
		$data['logoutafter']=@$jj->logoutafter;
		$this->load->view('user/formedit_group',$data);
	}
	function edit_group_aksi(){
        $this->form_validation->set_rules("nama_section","Nama Section","required");
		if($this->form_validation->run()) {
			$this->m_user->edit_grup_aksi($_POST['idd'],$_POST);
			echo "sukses#"."add#";
		 } else {
			echo "error-".validation_errors()."#0";	
		 }
	}
////////////////////////////////////////////////////////////////////
	function formhapusgroup(){
		$data['group_id']=$_POST['group_id'];
		$hslquery=$this->m_user->detail_grup($_POST['group_id'])->result();
			$jj = json_decode($hslquery[0]->meta_value);
		$data['group_name']=$hslquery[0]->nama_item;
		$data['section_name']=$jj->section_name;
		$data['backoffice']=$jj->back_office;
		$data['keterangan']=$jj->keterangan;
		$this->load->view('user/formhapus_group',$data);
	}
	function hapus_group_aksi(){
		$group_id=$_POST['idd'];
		$this->m_user->hapus_grup_aksi($group_id);
			echo "sukses#"."add#";
	}
////////////////////////////////////////////////////////////////////
	function ganti_password(){
		$data['satu'] = "Penggantian Password Pengguna";
		$data['user'] = $this->session->userdata('logged_in');
		$this->load->view('user/form_ganti_password',$data);
	}
	function ganti_password_aksi(){
		$_POST['pw1'] = $this->security->xss_clean($this->input->post('pw1'));
		$_POST['pw2'] = $this->security->xss_clean($this->input->post('pw2'));
		if($_POST['pw1']!="" && $_POST['pw1']==$_POST['pw2']){
			$sess = $this->session->userdata('logged_in');
			$_POST['user_id'] = $sess['id_user'];
			$this->m_user->ganti_password($_POST);
			echo "success";
		} else {
			echo "successv";
		}
	}

}
?>