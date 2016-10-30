<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Widget extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_widget');
	}

	function index(){
		$data['isi'] = $this->m_widget->getwidget();
		foreach($data['isi'] AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$data['isi'][$key]->lokasi_widget = $jj->lokasi_widget;
			@$data['isi'][$key]->keterangan = @$jj->keterangan;

			$cek=$this->m_widget->cek_widget($val->id_item);
			if(!empty($cek)){@$data['isi'][$key]->cek="ada";}	else	{@$data['isi'][$key]->cek="kosong";}

		}
		$this->load->view('widget/index',$data);
	}
	function formedit(){
		$data['isi']=$this->m_widget->detail_widget($_POST['idd']);
		$df = json_decode($data['isi']->meta_value);
		$data['keterangan'] = $df->keterangan;

		$data['pil'] = Modules::run("cmshome/lokasi_widget_options",$df->lokasi_widget);
		$this->load->view('widget/formedit',$data);
	}
	function edit_aksi(){
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nama_widget']=$ang[0];
			$ipp['keterangan']=$ang[1];
			$ipp['lokasi']=$ang[2];
			$idw = $ang[3];
		$proses = $this->m_widget->edit_widget_aksi($idw,$ipp);
		echo $proses;
	}

	function formtambah(){
		$data['pil'] = Modules::run('cmshome/lokasi_widget_options','');
		$this->load->view('widget/formtambah',$data);
	}
	function tambah_aksi(){
		$ang=explode("*",$_POST['nama_user']);
			$ipp['nama_widget']=$ang[0];
			$ipp['keterangan']=$ang[1];
			$ipp['lokasi']=$ang[2];
		$proses = $this->m_widget->tambah_widget_aksi($ipp);
		echo $proses;
	}

	function formhapus(){
		$data['isi']=$this->m_widget->detail_widget($_POST['idd']);
		$df = json_decode($data['isi']->meta_value);
		$data['keterangan'] = $df->keterangan;

		$data['pil'] = Modules::run("cmshome/lokasi_widget_options",$df->lokasi_widget);
		$this->load->view('widget/formhapus',$data);
	}
	function hapus_aksi(){
		$idd=$_POST['nama_user'];
		$this->m_widget->hapus_widget_aksi($idd);
		echo "sukses";
	}

}
?>