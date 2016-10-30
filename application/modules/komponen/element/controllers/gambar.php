<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gambar extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_element');
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function index($id_konten)	{
		$data['id_konten']=$id_konten;
		$data['gambar']=$this->m_element->gambar_artikel($id_konten);
			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/element/gambar.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/element/';
				$this->load->view($this->viewPath.'gambar',$data);
			} else {
				$this->load->view('gambar',$data);
			}
	}
}