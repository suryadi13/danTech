<?php
class M_statis extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getstatis($path){
		if($path=="xx"){$and1="";}else{$and1=" WHERE a.id_kategori='$path'";}
		$sqlstr="SELECT a.judul, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal,a.id_konten,b.nama_item AS nama_kategori, a.isi_konten,c.nama_item AS nama_penulis
		FROM konten a 
		LEFT JOIN (cmf_setting b,cmf_setting c) 
		ON (a.id_kategori=b.id_item AND b.id_setting IN (8,9) AND a.komponen='statis' AND c.id_setting='11' AND a.id_penulis=c.id_item) $and1 
		ORDER BY a.id_konten DESC  LIMIT 0,1";

		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}

	function inistatis($idd){
////khusus untuk menampilkan "hasil pencarian"
		$sqlstr="SELECT a.id_konten,a.id_kategori,a.judul,a.id_kategori AS id_kanal,b.nama_item AS nama_kategori, a.isi_konten,c.nama_item AS nama_penulis
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item)
		LEFT JOIN (cmf_setting c) ON (c.id_setting='11' AND a.id_penulis=c.id_item)
		WHERE id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}

}
