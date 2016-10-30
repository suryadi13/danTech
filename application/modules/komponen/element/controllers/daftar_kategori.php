<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_kategori extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_element');
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function index($id_kanal,$komponen="xxx",$ikat=1000)	{
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$daf_kategori=$this->m_element->cari_rubrik_kanal($id_kanal);
		foreach($daf_kategori as $key=>$val){
			@$daf_kategori[$key]->status=($daf_kategori[$key]->id_kategori==$ikat)?"active":"";		
			$daf_kategori[$key]->seo=str_replace($d, '-', $val->nama_kategori);
		}
		return $daf_kategori;
	}
}