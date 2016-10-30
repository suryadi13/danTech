<?php
class M_agenda extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_aksi($isi){
		$ini="{\"tgl_mulai\":\"".$isi['tgl_mulai']."\",\"tgl_selesai\":\"".$isi['tgl_selesai']."\",\"isi\":\"".$isi['isi_agenda']."\"}";
		$sqlstr="INSERT INTO konten (judul,komponen,id_kategori,isi_konten,sub_judul) 
		VALUES ('".$isi['tema']."','agenda','".$isi['id_kategori']."','$ini','".$isi['tempat']."')";		
		$this->db->query($sqlstr);
	}
    function edit_aksi($isi){
		$ini="{\"tgl_mulai\":\"".$isi['tgl_mulai']."\",\"tgl_selesai\":\"".$isi['tgl_selesai']."\",\"isi\":\"".$isi['isi_agenda']."\"}";
		$sqlstr="UPDATE konten SET judul='".$isi['judul']."',id_kategori='".$isi['id_kategori']."',isi_konten='$ini',sub_judul='".$isi['sub_judul']."' WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function hapus_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_konten='$isi'";
		$this->db->query($sqlstr);
	}
}
