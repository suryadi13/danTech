<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Comment extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_comment');
	}
	
	function index(){
		$data['jform']="Pengaturan Komentar";
        $data["hal"] = (isset($_POST["hal"]))?$_POST["hal"]:"1";
        $data["batas"] = (isset($_POST["batas"]))?$_POST["batas"]:10;
        $data["cari"] = (isset($_POST["cari"]))?$_POST["cari"]:"";
/*
			$sess = $this->session->userdata('logged_in');
			$data['ssb'] = $sess;
			$sess = $this->session->all_userdata();
			$data['ssn'] = $sess;
			$data['PHPSESSID']= $this->session->userdata('session_id');
*/
		$this->load->view('comment/index',$data);
	}
	function getdata(){
		$komponen="bukutamu";
		$data['count'] = $this->m_comment->hitung_komen($_POST['cari'],$komponen,$_POST['id_kat']);
		if($data['count']==0){
			$data['hslquery']="";
			$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
		} else {
			$batas=$_POST['batas'];
			$hal = ($_POST['hal']=="end")?ceil($data['count']/$batas):$_POST['hal'];
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
			$data['hslquery'] = $this->m_comment->get_komen($_POST['cari'],$mulai,$batas,$komponen,$_POST['id_kat']);
			foreach($data['hslquery'] as $it=>$val){
					if($val->id_konten==0){
						@$data['hslquery'][$it]->konten="Bukutamu";
					}	else	{
						$kk = $this->m_comment->ini_konten($val->id_konten);
						@$data['hslquery'][$it]->konten = ucfirst($kk->komponen)." :: ".$kk->tanggal."<br>".$kk->nama_kategori."<br/><small>".$kk->judul."</small>";
					}
					$jawaban = $this->m_comment->ini_jawaban($val->id_komentar);
					@$data['hslquery'][$it]->jawaban = (!empty($jawaban))?$jawaban->isi_komentar:"...";
					@$data['hslquery'][$it]->tanggal_jawaban = (!empty($jawaban))?$jawaban->tanggal_komentar:"...";
			}

			$data['pager'] = Modules::run("web/pagerC",$data['count'],$batas,$hal);
		}
		echo json_encode($data);
	}
	function formedit(){
		$data['isi'] = $this->m_comment->ini_komentar($_POST['id_komentar']);
		$data['jawaban'] = $this->m_comment->ini_jawaban($_POST['id_komentar']);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('comment/formedit',$data);
	}
	function formtarik(){
		$data['isi'] = $this->m_comment->ini_komentar($_POST['id_komentar']);
		$data['jawaban'] = $this->m_comment->ini_jawaban($_POST['id_komentar']);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('comment/formtarik',$data);
	}
	function formdorong(){
		$data['isi'] = $this->m_comment->ini_komentar($_POST['id_komentar']);
		$data['jawaban'] = $this->m_comment->ini_jawaban($_POST['id_komentar']);
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];
		$this->load->view('comment/formdorong',$data);
	}
	function edit_aksi(){
		$this->m_comment->jawab_aksi($_POST);
		echo "sukses#"."add#";
	}
	function tarik_aksi(){
		$this->m_comment->tarik_aksi($_POST);
		echo "sukses#"."add#";
	}
	function dorong_aksi(){
		$this->m_comment->dorong_aksi($_POST);
		echo "sukses#"."add#";
	}


}
?>