<?php
class M_last_artikel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
///////////////////////////////////////////
	function getwidget($idd,$ini,$limit){
		$sqlstr3="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		ORDER BY a.tanggal DESC LIMIT 0,$limit";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
}
