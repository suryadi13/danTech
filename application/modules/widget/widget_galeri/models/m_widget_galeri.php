<?php
class M_widget_galeri extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($ini){
		$sqlstr3="SELECT a.*, 
		(SELECT DAYNAME(a.tanggal)) AS hari_buat, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, 
		(SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND tipe='foto' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto, 
		b.nama_item AS nama_kategori
		FROM konten a
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9')
		WHERE a.id_kategori IN ($ini)
		ORDER BY a.tanggal DESC  LIMIT 0,4";
		$hslquery3=$this->db->query($sqlstr3)->result();
		return $hslquery3;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
