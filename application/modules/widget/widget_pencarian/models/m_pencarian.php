<?php
class M_pencarian extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitungpencarian($cari){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten 
		WHERE  judul LIKE '%$cari%' OR isi_konten LIKE '%$cari%'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}

	function getpencarian($cari,$mulai,$batas){
		$sqlstr="SELECT 
		a.*, 
		(SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal,b.nama_item AS nama_kategori
		FROM konten a 
		LEFT JOIN (cmf_setting b) 
		ON (a.id_kategori=b.id_item) 
		WHERE  a.judul LIKE '%$cari%' OR a.isi_konten LIKE '%$cari%'
		ORDER BY a.id_konten DESC  LIMIT $mulai,$batas";

		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

}
