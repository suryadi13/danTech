<?php
class M_penulis extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getpenulis($mulai,$batas,$path){
		if($path=="xx"){$and1="";}else{$and1=" AND a.nama_item LIKE '%$path%'";}
		$sqlstr="SELECT a.* FROM cmf_setting a WHERE a.id_setting='6' $and1 ORDER BY a.id_item  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function hitung_penulis($path){
		if($path=="xx"){$and1="";}else{$and1=" AND a.nama_item LIKE '%$path%'";}
		$query=$this->db->query("SELECT COUNT(a.id_item) as count_nik FROM cmf_setting a WHERE a.id_setting='6' $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
    function detail_penulis($idd){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
    function cek_penulis($usn){
		$sqlstr="SELECT * FROM konten WHERE id_penulis='$usn'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function tambah_penulis_aksi($ipp){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='6'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = (isset($hslquery->maxid))?$hslquery->maxid+1:900001;

			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,nama_item,meta_value) 
			VALUES ('$maxid','6','".$ipp['nama_penulis']."','".$ipp['keterangan']."')";		
			$this->db->query($sqlstr);
			$hasil = "sukses";
		return $hasil;
	}
    function edit_penulis_aksi($idg,$ipp){
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_penulis']."',meta_value='".$ipp['keterangan']."' WHERE id_item='$idg'";
			$this->db->query($sqlstr);
			$hasil = "sukses";
		return $hasil;
	}
    function hapus_penulis_aksi($idg){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idg'";
		$this->db->query($sqlstr);
	}
}
