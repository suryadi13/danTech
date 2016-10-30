<?php
class M_boot_cmsdashboard extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getopsi(){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='5'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function hitung_konten($path,$komp){
		if($path=="xx"){$and1=" WHERE komponen='$komp'";}else{$and1=" WHERE komponen='$komp' AND id_kategori='$path'";}
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function get_konten($mulai,$batas,$path,$komp){
		if($path=="xx"){$and1=" WHERE komponen='$komp'";}else{$and1=" WHERE komponen='$komp' AND id_kategori='$path'";}
		$sqlstr="SELECT * FROM konten  $and1 ORDER BY urutan DESC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function detail_konten($idd){
		$sqlstr="SELECT a.*,b.nama_item AS nama_kategori
		FROM konten a 
		LEFT JOIN cmf_setting b ON (b.id_setting='6' AND a.id_kategori=b.id_item) 
		WHERE a.id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function foto_konten($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function get_penulis($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT a.id_item AS id_penulis, a.nama_item AS nama_penulis FROM cmf_setting a WHERE a.id_setting='11' ORDER BY a.urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_komponen($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='7' ORDER BY urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_theme($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='12' ORDER BY urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_rubrik($komponen,$mulai,$batas){
		$sqlstr="SELECT a.id_item AS id_kategori,a.nama_item AS nama_kategori
		FROM cmf_setting a 
		WHERE a.id_setting='6' AND a.meta_value LIKE '%\"komponen\":\"$komponen\"%'
		ORDER BY a.urutan ASC 
		LIMIT $mulai,$batas"; 
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}




}
