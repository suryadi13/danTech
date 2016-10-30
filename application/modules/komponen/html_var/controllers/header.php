<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_web_var');
		$this->load->model('m_web');
	}

	function index(){
		$sess = $this->session->userdata('visit');
		$header = $this->m_web_var->get_var_header($sess['id_kanal']);
		$data['header'] = json_decode($header->meta_value);
		$pth = json_decode($header->mtt);
		$data['pth'] = $pth->path_kanal;
		$data['logo_app']=($header->nama_item=="")?base_url()."assets/media/logo_kanal/".$this->m_web->getopsivalue('logo_app'):base_url()."assets/media/logo_kanal/".$sess['id_kanal']."/".$header->nama_item;

			$path='assets/themes/'.$sess['theme'].'/komponen/html_var/header.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/html_var/';
				$this->load->view($this->viewPath.'header',$data);
			} else {
				$this->load->view("header",$data);
			}
	}
//////////////////////////////////////////////////////////////////////////////////////////
}	
?>