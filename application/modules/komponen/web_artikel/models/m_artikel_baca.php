<?php
class M_artikel_baca extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_artikel($idd){
		$sqlstr="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,c.nama_item AS nama_kategori,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='9' AND c.id_item=a.id_kategori)
		WHERE a.id_konten='$idd' AND a.komponen='artikel'";
		$hslquery=$this->db->query($sqlstr)->row();

		$jj = json_decode($hslquery->meta_value);
		$hslquery->id_kanal=$jj->id_kanal;

		return $hslquery;
	}
	function hitung_artikel($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_kategori='$path' AND komponen='artikel'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function urutan_artikel($idd,$path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_konten>='$idd' AND komponen='artikel' AND id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getartikel($mulai,$batas,$path){
		if($path=="xx"){$and1="";}else{$and1=" WHERE a.id_kategori='$path'";}
		$sqlstr="SELECT a.judul,a.sub_judul, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal,a.id_konten,b.nama_item AS nama_kategori, a.isi_konten,c.nama_item AS nama_penulis,
		(SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND tipe='foto' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto
		FROM konten a 
		LEFT JOIN (cmf_setting b,cmf_setting c) 
		ON (a.id_kategori=b.id_item AND b.id_setting='9' AND a.komponen='artikel' AND c.id_setting='6' AND a.id_penulis=c.id_item) $and1 
		ORDER BY a.id_konten DESC  LIMIT $mulai,$batas";

		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function nama_rubrik($path){
		$qry = "SELECT * FROM cmf_setting WHERE id_item='$path'"; 
		$hsl = $this->db->query($qry)->row();
		return $hsl;
	}
//////////////////////////////////////////////////////////////////////////////////
}