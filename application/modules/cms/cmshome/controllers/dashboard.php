<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_home');
		$this->auth->restrict();
	}
	
	function admin(){

		$data['logo'] = $this->m_home->getopsivalue("logo_app");

		$id_app = $this->m_home->getopsi();
		foreach($id_app AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$data['id_app'][$key]->id = $val->id_item;
			@$data['id_app'][$key]->nama = $val->nama_item;
			@$data['id_app'][$key]->label = $jj->label;
			@$data['id_app'][$key]->nilai = $jj->nilai;
			@$data['id_app'][$key]->tipe = $jj->tipe;
		}

		$this->load->view('dashboard/webadmin',$data);
	}

	function webadmin(){

		$data['logo'] = $this->m_home->getopsivalue("logo_app");

		$id_app = $this->m_home->getopsi();
		foreach($id_app AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$data['id_app'][$key]->id = $val->id_item;
			@$data['id_app'][$key]->nama = $val->nama_item;
			@$data['id_app'][$key]->label = $jj->label;
			@$data['id_app'][$key]->nilai = $jj->nilai;
			@$data['id_app'][$key]->tipe = $jj->tipe;
		}

		$this->load->view('dashboard/webadmin',$data);
	}


}
?>