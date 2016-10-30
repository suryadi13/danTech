<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Footer extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	public function index(){
		echo $_POST['posisi'];

	}


}
?>