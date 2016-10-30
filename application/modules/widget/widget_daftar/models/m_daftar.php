<?php
class M_daftar extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($ini,$mulai,$opsi){
		$sqlstr3="SELECT a.*, b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) LIMIT $mulai,$opsi";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
	function hitung_item($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
