<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navbar extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_web_var');
	}

	function index($id_kanal){	 // 0 = default-> INDUK	
		$sess = $this->session->userdata('visit');
		$data['id_kanal'] = $sess['id_kanal'];
		$data['pkanal'] = $sess['kanal'];
		$data['default']=Modules::run("web/defaultkanal");
		$data['kanal'] = $this->get_kanal_on();
			$path='assets/themes/'.$sess['theme'].'/komponen/html_var/navbar.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/html_var/';
				$this->load->view($this->viewPath.'navbar',$data);
			} else {
				$this->load->view("navbar",$data);
			}
	}
//////////////////////////////////////////////////////////////////////////////////////////
	function get_kanal_on($id_parent=0){
		$knl = array();
		$kanal = $this->m_web_var->getkanal_on($id_parent);
		foreach($kanal AS $key=>$val){
			$knl[$key] = $kanal[$key];
			$jj=json_decode($val->meta_value);
			$knl[$key]->path_kanal = $jj->path_kanal;

			$knl2 = $this->get_kanal_on($val->id_kanal);
			foreach($knl2 AS $key2=>$val2){
				$knl[$key]->anak = $knl2;
			}
		}
		return $knl;
	}
}	
?>