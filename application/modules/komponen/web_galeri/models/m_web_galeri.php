<?php
class M_web_galeri extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_galeri($idd){
		$sqlstr="SELECT a.*,DAYNAME(a.tanggal) AS hari_buat, 
		DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,c.nama_item AS nama_kategori,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='9' AND c.id_item=a.id_kategori)
		WHERE a.id_konten='$idd' AND a.komponen='galeri'";

		$hslquery=$this->db->query($sqlstr)->row();
		$jj = json_decode($hslquery->meta_value);
		$hslquery->id_kanal=$jj->id_kanal;

		return $hslquery;
	}
	function album_galeri($idd){
		$sqlstr="SELECT a.*
		FROM konten_appe a
		LEFT JOIN (konten b)
		ON (b.id_konten=a.id_konten)
		WHERE a.id_konten='$idd' AND a.tipe='foto' ORDER BY a.urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function getfoto($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_appe='$idd'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_album($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_kategori='$path' AND komponen='galeri'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getalbum($mulai,$batas,$path){
		$sqlstr="SELECT a.*, (SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND tipe='foto' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto,
		DAYNAME(a.tanggal) AS hari_buat, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, 
		b.nama_item AS nama_kategori
		FROM konten a
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9')
		WHERE a.id_kategori='$path' AND a.komponen='galeri'
		ORDER BY a.id_konten DESC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function urutan_galeri($idd,$path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_konten>='$idd' AND id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
}
