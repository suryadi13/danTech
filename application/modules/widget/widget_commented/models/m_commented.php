<?php
class M_commented extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($ini){
		$sqlstr3="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN cmf_setting b ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) AND a.komponen='artikel' ORDER BY a.tanggal DESC LIMIT 0,6";

		$sqlstr4="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, b.nama_item AS nama_kategori 
		FROM konten a 
		LEFT JOIN cmf_setting b ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE a.id_kategori IN ($ini) AND a.komponen='artikel' ORDER BY a.baca DESC LIMIT 0,6";

		$comment['komentar']=$this->db->query($sqlstr3)->result();
		$comment['populer']=$this->db->query($sqlstr4)->result();

		return $comment;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
