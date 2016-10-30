<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sub_menu extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_menu');
	}

	function index(){
		$data['setting']	= "Menu";
		$this->load->view('sub_menu/index',$data);
	}




	function menu_grup(){
		$data['setting']	= "Menu Pengguna";
		$data['setting_ref']	= "Menu";

		$data['id_setting']	= 3;
		$data['id_setting_ref']	= 2;
		$grup = Modules::run("cmsadmin/user/getusergroup");
		$data['grup'] = json_decode($grup);

		$this->load->view('sub_menu/menu_grup',$data);
	}

}
?>