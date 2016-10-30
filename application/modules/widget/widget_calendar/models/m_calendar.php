<?php
class M_calendar extends CI_Model{
	function __construct(){
		parent::__construct();
	}
///////////////////////////////////////////
/*
	function getwidget($ini,$limit){
		$sqlstr3="SELECT a.*,b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='6') 
		WHERE a.id_kategori IN ($ini) LIMIT 0,$limit";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
	function getpilihanpolling($path){
		$sqlstr="SELECT * FROM konten_appe WHERE tipe='polling_pilihan' AND id_konten='$path' ORDER BY urutan_appe ASC"; 
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
*/
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
