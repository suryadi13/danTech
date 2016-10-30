<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Penulis extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_penulis');
	}

	function index(){
        $data["hal"] = (isset($_POST["hal"]))?$_POST["hal"]:"end";
        $data["batas"] = (isset($_POST["batas"]))?$_POST["batas"]:10;
        $data["cari"] = (isset($_POST["cari"]))?$_POST["cari"]:"";
		$this->load->view('penulis/index',$data);
	}

	function getpenulis(){
		$batas=$_POST['batas'];
		if($_POST['cari']!=""){ $path=$_POST['cari']; } else { $path="xx"; }
		$dt=$this->m_penulis->hitung_penulis($path); 

		if($dt['count']==0){
			$data['hslquery']="";
			$data['pager'] = "";
		} else { 

			if($_POST['hal']=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$_POST['hal'];	}
			$mulai=($hal-1)*$batas;
			$data['mulai']=$mulai+1;
	
			$data['hslquery']=$this->m_penulis->getpenulis($mulai,$batas,$path)->result();
			foreach($data['hslquery'] as $it=>$val){
				$id=$data['hslquery'][$it]->id_item;
					$cek=$this->m_penulis->cek_penulis($id);
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
		$this->load->view('penulis/formtambah',$data);
	}
	function tambah_aksi(){
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nama_penulis']=$ang[0];
			$ipp['keterangan']=$ang[1];
		$proses = $this->m_penulis->tambah_penulis_aksi($ipp);
		echo $proses;
	}
	function formedit(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];

		$data['isi']=$this->m_penulis->detail_penulis($_POST['id_penulis']);
		$this->load->view('penulis/formedit',$data);
	}
	function edit_aksi(){
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nama_penulis']=$ang[0];
			$ipp['keterangan']=$ang[1];
			$idd=$ang[2];
		$proses = $this->m_penulis->edit_penulis_aksi($idd,$ipp);
		echo $proses;
	}
	function formhapus(){
		$data['hal'] = $_POST['hal'];
		$data['batas'] = $_POST['batas'];
		$data['cari'] = $_POST['cari'];

		$data['isi']=$this->m_penulis->detail_penulis($_POST['id_penulis']);
		$this->load->view('penulis/formhapus',$data);
	}
	function hapus_aksi(){
		$idd=$_POST['nama_user'];
		$this->m_penulis->hapus_penulis_aksi($idd);
		echo "sukses";
	}
}
?>