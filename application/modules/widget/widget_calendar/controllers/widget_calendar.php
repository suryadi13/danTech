<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_calendar extends MX_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta'); 
	}	

	public function index($id_widget,$id_wrapper,$opsi){

		$data['tahun'] = date('Y');
		$data['bulan'] = date('m');
		$data['idd']=$id_wrapper;
		$data['margin_top']=$opsi[0]->nilai;

		$this->load->view('index',$data);
	}

	public function p_json(){
		$bulan = $_GET['month'];
		$tahun =  $_GET['year'];
		$cari=$tahun."-".$bulan."-01";

		$sqlstr="SELECT a.*,c.nama_item AS nama_kategori,c.id_item AS id_kategori,c.id_parent,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='6' AND c.id_item=a.id_kategori)
		WHERE a.komponen='agenda'";
		$rr = $this->db->query($sqlstr)->result();

	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";


echo '[';
	$i=0;
	foreach($rr AS $key=>$val){
		$sep = ($i==0)?"":",";
			$kat_seo=str_replace($d, '-', $val->nama_kategori);
			$seo=str_replace($d, '-', $val->judul);
			$tt = json_decode($val->isi_konten);
		echo $sep.'{ "date": "'.$tt->tgl_mulai.' 00:00:00", "type": "meeting", "title": "'.$val->judul.'", "description": "", "url": "'.site_url().'read/agenda/'.$val->id_konten.'/'.$kat_seo.'/'.$seo.'" }';
		$i++;
	}
echo ']';
	}


}