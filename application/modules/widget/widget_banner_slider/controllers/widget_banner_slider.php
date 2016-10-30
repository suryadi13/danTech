<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_banner_slider extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('widget_banner_main/m_web_banner');
	}	

	public function index($id_widget,$id_konten,$opsi,$nno){

		$data['daftar'] = $this->m_web_banner->getwidget($id_konten);
		$data['margin_top']=$opsi[0]->nilai;
		$data['durasi']=$opsi[2]->nilai;
		$data['idd'] = $nno;

		$this->load->view('index',$data);
	}
}