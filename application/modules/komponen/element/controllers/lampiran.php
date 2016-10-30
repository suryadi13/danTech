<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lampiran extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_element');
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function index($id_konten)	{
		$data['lampiran']=$this->m_element->lampiran_artikel($id_konten);
			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/element/lampiran.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/element/';
				$this->load->view($this->viewPath.'lampiran',$data);
			} else {
				$this->load->view('lampiran',$data);
			}
	}
}