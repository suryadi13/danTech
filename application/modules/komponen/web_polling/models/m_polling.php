<?php
class M_polling extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_polling($idd){
		$sqlstr="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,c.nama_item AS nama_kategori,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='9' AND c.id_item=a.id_kategori)
		WHERE a.id_konten='$idd' AND a.komponen='polling'";
		$hslquery=$this->db->query($sqlstr)->row();
		$jj = json_decode($hslquery->meta_value);
		$hslquery->id_kanal=$jj->id_kanal;

		return $hslquery;
	}
	function hitung_polling($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_kategori='$path' AND komponen='polling'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function urutan_polling($idd,$path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_konten>='$idd' AND komponen='polling' AND id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getpolling($mulai,$batas,$path){
		if($path=="xx"){$and1="";}else{$and1=" WHERE a.id_kategori='$path'";}
		$sqlstr="SELECT a.judul, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal,a.id_konten,b.nama_item AS nama_kategori, a.isi_konten,
		(SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND tipe='foto' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto
		FROM konten a 
		LEFT JOIN (cmf_setting b) 
		ON (a.id_kategori=b.id_item AND b.id_setting='9' AND a.komponen='polling') $and1 
		ORDER BY a.id_konten DESC  LIMIT $mulai,$batas";

		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function get_pilihan($isi){
		$sqlstr = "SELECT * FROM konten_appe WHERE tipe='polling_pilihan' AND id_konten='$isi' ORDER BY urutan_appe ASC";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function counter($idd){
		$hslqueryp = $this->db->get_where('konten_appe', array('id_appe' => $idd))->result();
		$ccc = $hslqueryp[0]->nilai+1;
		$sqlstr="UPDATE konten_appe SET nilai='$ccc' WHERE id_appe='$idd'";
		$this->db->query($sqlstr);
	}
}
