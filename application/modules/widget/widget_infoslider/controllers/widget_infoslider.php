<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_infoslider extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_infoslider');
	}

	public function index($nama_wrapper,$id_kat,$opsi)	{
		$data['nama_wrapper'] = $nama_wrapper;
		$batas=$opsi[2]->nilai;
		$data['daftar'] = $this->m_infoslider->getwidget($id_kat,$batas);
		$data['margin_top']=$opsi[0]->nilai;
		$data['margin_bottom']=$opsi[1]->nilai;
		$data['durasi']=$opsi[3]->nilai;
		$this->load->view('index',$data);
	}

}