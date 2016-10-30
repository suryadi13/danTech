<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_web_var');
	}

	function index(){
			$data['tahun'] = "2014 mamak";

			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/html_var/footer.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/html_var/';
				$this->load->view($this->viewPath.'footer',$data);
			} else {
				$this->load->view("footer");
			}
	}

//////////////////////////////////////////////////////////////////////////////////////////
}	
?>