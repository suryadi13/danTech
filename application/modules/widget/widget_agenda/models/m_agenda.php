<?php
class M_agenda extends CI_Model{
	function __construct(){
		parent::__construct();
	}
///////////////////////////////////////////
	function getwidget($idd,$ini,$limit){
		$sqlstr3="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) ORDER BY a.tanggal DESC LIMIT 0,$limit";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
	function gambar_artikel($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='foto'";
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
