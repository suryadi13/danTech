<?php
class M_index_tutorial extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function getwidget($ini){
		$sqlstr3="SELECT a.nama_item AS nama_kategori, a.id_item AS id_kategori 
		FROM cmf_setting a 
		WHERE a.id_item IN ($ini) ORDER BY a.urutan ASC";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
	function getisi($idd){
		$sqlstr="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal
		FROM konten a 
		WHERE a.id_kategori=$idd ORDER BY a.tanggal DESC LIMIT 0,10";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
