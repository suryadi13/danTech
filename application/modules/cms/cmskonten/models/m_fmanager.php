<?php
class M_fmanager extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getitem($idp){
		$sqlstr="SELECT a.*	FROM konten_appe a WHERE a.tipe='fm' AND a.id_konten='$idp' ORDER BY a.id_appe";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function cek_folder($idp,$pth){
		$sqlstr="SELECT a.*	FROM konten_appe a WHERE a.tipe='fm' AND a.id_konten='$idp' AND link='$pth'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_folder($idd){
		$sqlstr="SELECT a.*	FROM konten_appe a WHERE a.id_appe='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function tambah_folder_aksi($idp,$ipp,$pth){
		$sqlstr="INSERT INTO konten_appe (tipe,id_konten,judul_appe,keterangan_appe,link) 
		VALUES ('fm','$idp','".$ipp['folder']."','".$ipp['keterangan']."','$pth')";		
		$this->db->query($sqlstr);
	}
	function edit_folder_aksi($idd,$ipp,$pth){
		$sqlstr="UPDATE konten_appe SET judul_appe='".$ipp['folder']."',keterangan_appe='".$ipp['keterangan']."',link='$pth' WHERE id_appe='$idd'";
		$this->db->query($sqlstr);
	}
	function hapus_folder_aksi($idd){
		$sqlstr="DELETE FROM konten_appe WHERE id_appe='$idd'";
		$this->db->query($sqlstr);
	}
	function hitungfile($idd){
		$sqlstr="SELECT COUNT(a.id_appe) AS jml FROM konten_appe a WHERE a.tipe='fml' AND a.id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery->jml;
	}
	function getfile($idd){
		$sqlstr="SELECT a.* FROM konten_appe a WHERE a.tipe='fml' AND a.id_konten='$idd' ORDER BY a.id_appe";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function simpan_file($idp,$ipp,$ket){
		$sqlstr="INSERT INTO konten_appe (tipe,id_konten,judul_appe,keterangan_appe) 
		VALUES ('fml','$idp','$ipp','$ket')";		
		$this->db->query($sqlstr);
	}
	function rename_fl($idd,$pth){
		$sqlstr="UPDATE konten_appe SET judul_appe='$pth' WHERE id_appe='$idd'";
		$this->db->query($sqlstr);
	}
}
