<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_agenda extends MX_Controller {

	function __construct()	{
		parent::__construct();
	}

	public function index($id_widget,$id_wrapper,$opsi)	{
		$data['idd']=$id_wrapper;
		$data['opsi'] = $opsi;
		$this->load->view('index',$data);
	}
}