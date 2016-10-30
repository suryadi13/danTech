<?php
class M_migrasi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function get_bukutamu(){
		$sqlstr="SELECT * FROM bukutamu ORDER BY tanggal_isian ASC LIMIT 0,10";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function bukutamu_import(){
		$sqlstr="SELECT * FROM bukutamu ORDER BY tanggal_isian ASC";
		$hslquery=$this->db->query($sqlstr)->result();

		foreach($hslquery AS $key=>$val){
			$nn = $key+9;
			$sqlstr="INSERT INTO konten_komentar (id_komentar,nama_komentator,email_komentator,tanggal_komentar,isi_komentar) 
			VALUES ('$nn','".$val->nama_pengisi."','".$val->email_pengisi."','".$val->tanggal_isian."','".$val->isian."')";		
			$this->db->query($sqlstr);
		}

	}
/*

    function tambah_aksi($isi){
		$ini="{\"tgl_mulai\":\"".$isi['tgl_mulai']."\",\"tgl_selesai\":\"".$isi['tgl_selesai']."\",\"isi\":\"".$isi['isi_agenda']."\"}";
		$sqlstr="INSERT INTO konten (judul,komponen,id_kategori,isi_konten,sub_judul) 
		VALUES ('".$isi['tema']."','agenda','".$isi['id_kategori']."','$ini','".$isi['tempat']."')";		
		$this->db->query($sqlstr);
	}
    function edit_aksi($isi){
		$ini="{\"tgl_mulai\":\"".$isi['tgl_mulai']."\",\"tgl_selesai\":\"".$isi['tgl_selesai']."\",\"isi\":\"".$isi['isi_konten']."\"}";
		$sqlstr="UPDATE konten SET judul='".$isi['judul']."',id_kategori='".$isi['id_kategori']."',isi_konten='$ini',sub_judul='".$isi['sub_judul']."' WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function hapus_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_konten='$isi'";
		$this->db->query($sqlstr);
	}

*/
}
