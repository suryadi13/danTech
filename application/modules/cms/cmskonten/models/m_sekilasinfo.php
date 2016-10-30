<?php
class M_sekilasinfo extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_aksi($isi){
		$sqlstr="INSERT INTO konten_appe (judul_appe,tipe,id_konten,keterangan_appe) 
		VALUES ('".$isi['judul']."','sekilasinfo','".$isi['id_kategori']."','".$isi['isi']."')";		
		$this->db->query($sqlstr);
	}
    function edit_aksi($isi){
		$sqlstr="UPDATE konten_appe SET judul_appe='".$isi['judul']."',id_konten='".$isi['id_kategori']."',keterangan_appe='".$isi['isi']."' WHERE id_appe='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function hapus_aksi($isi){
		$sqlstr="DELETE FROM konten_appe WHERE id_appe='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
	function detailkonten($path){
		$sqlstr="SELECT * FROM konten_appe  WHERE id_appe='$path'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_konten($path,$komp){
		if($path=="xx"){$and1=" WHERE tipe='$komp'";}else{$and1=" WHERE tipe='$komp' AND id_konten='$path'";}
		$query=$this->db->query("SELECT count(id_appe) as count_nik FROM konten_appe $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function get_konten($mulai,$batas,$path,$komp){
		if($path=="xx"){$and1=" WHERE tipe='$komp'";}else{$and1=" WHERE tipe='$komp' AND id_konten='$path'";}
		$sqlstr="SELECT * FROM konten_appe  $and1 ORDER BY urutan_appe DESC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);

		return $hslquery;
	}
/////////////////////////////////////////////////////////
    function tambah_kategori_aksi($isi){
			$ini="{\"komponen\":\"sekilasinfo\",\"keterangan\":\"".$isi['keterangan']."\",\"status\":\"publish\"}";
			$sqlstr="INSERT INTO cmf_setting (id_setting,nama_item,meta_value) VALUES ('6','".$isi['nama_kategori']."','$ini')";		
			$this->db->query($sqlstr);
	}
    function edit_kategori_aksi($isi){
			$ini="{\"komponen\":\"sekilasinfo\",\"keterangan\":\"".$isi['keterangan']."\",\"status\":\"publish\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$isi['nama_kategori']."',meta_value='$ini' WHERE id_item='".$isi['idd']."'";		
			$this->db->query($sqlstr);
	}
    function hapus_kategori_aksi($isi){
			$sqlstr="DELETE FROM cmf_setting WHERE id_item='".$isi['idd']."'";		
			$this->db->query($sqlstr);
	}

	function cek_wrapper($id_kategori){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND (meta_value LIKE '%\"id_kategori\":\"$id_kategori\"%' OR meta_value LIKE '%\"id_kategori\":\"$id_kategori,%' OR meta_value LIKE '%,$id_kategori\"%' OR meta_value LIKE '%,$id_kategori,%' )";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}


}
