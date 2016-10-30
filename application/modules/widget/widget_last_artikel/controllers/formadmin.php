<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_last_artikel');
	}

	public function tambah()	{
			$tpl_1= Modules::run("cmshome/margin_options","10px");
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options","10px");
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$tpl_3= Modules::run("cmshome/banyak_post_options",5);
			$data['banyak_post']="<select id='nilai[2]' name='nilai[2]'  class='form-control'>".$tpl_3."</select>";
		$this->load->view('formadmin',$data);
	}
	public function edit()	{
		$data['nilai'] = explode(",",$_POST['opsi']);

			$tpl_1= Modules::run("cmshome/margin_options",$data['nilai'][0]);
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options",$data['nilai'][1]);
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$tpl_3= Modules::run("cmshome/banyak_post_options",$data['nilai'][2]);
			$data['banyak_post']="<select id='nilai[2]' name='nilai[2]'  class='form-control'>".$tpl_3."</select>";

		$this->load->view('formadmin',$data);
	}

}