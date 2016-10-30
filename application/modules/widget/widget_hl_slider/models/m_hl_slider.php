<?php
class M_hl_slider extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($idd,$ini,$limit){
/*
		$sqlstr3="SELECT a.*,b.nama_item AS nama_kategori
		FROM konten a 
		LEFT JOIN cmf_setting b 
		ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) LIMIT 0,4";
		$hslquery3=$this->db->query($sqlstr3);
*/

		$sqlstr3="SELECT a.*,b.nama_item AS nama_kategori, b.id_item AS id_kategori, b.id_parent AS id_kanal,
		(SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON 
		(a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) ORDER BY tanggal DESC,id_konten DESC LIMIT 0,$limit";
		$hslquery3=$this->db->query($sqlstr3)->result();

		return $hslquery3;
	}
	function cekimage($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='hl_slider'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
	function sliderkonten($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='hl_slider'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function simpan_slider($idd,$nama,$komponen){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$idd' AND tipe='hl_slider'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,tipe,foto,urutan_appe) 
		VALUES ('$idd','hl_slider','$nama','$max')";		
		$this->db->query($sqlstr);
	}
//////////////////////////////////////////////////////////////////////////////////
}
