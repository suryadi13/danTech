<?php
class M_comment extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function hitung_komen($cari,$komponen,$idKat){
		if($idKat==""){	$iKat="";	} else {	$iKat="AND id_kategori='$idKat'";}
		$sqlstr="SELECT COUNT(a.id_komentar) AS numrows
		FROM (konten_komentar a)
		WHERE  (
		a.id_induk='0'
		AND a.isi_komentar LIKE '%$cari%'
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_komen($cari,$mulai,$batas,$komponen,$idKat){
		$sqlstr="SELECT a.*
		FROM konten_komentar a
		WHERE  (
		a.id_induk='0'
		AND a.isi_komentar LIKE '%$cari%'
		)
		ORDER BY tanggal_komentar DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_konten($idd){
		$sqlstr="SELECT a.judul,a.komponen,a.tanggal,b.nama_item AS nama_kategori FROM konten a LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item) WHERE  id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_komentar($idd){
		$sqlstr="SELECT a.* FROM konten_komentar a WHERE  id_komentar='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_jawaban($idd){
		$sqlstr="SELECT a.* FROM konten_komentar a WHERE  id_induk='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function jawab_aksi($isi){
		date_default_timezone_set("Asia/Bangkok");
		$jj = $this->ini_jawaban($isi['id_komentar']);
		$sekarang = date('Y-m-d H:i:s');
		if(empty($jj)){
			$sqlstr="INSERT INTO konten_komentar (isi_komentar,id_induk,tanggal_komentar) 
			VALUES ('".$isi['isi_jawaban']."','".$isi['id_komentar']."','$sekarang')";		
			$this->db->query($sqlstr);
		} else {
			$sqlstr="UPDATE konten_komentar SET isi_komentar='".$isi['isi_jawaban']."',tanggal_komentar='$sekarang' WHERE id_induk='".$isi['id_komentar']."'";
			$this->db->query($sqlstr);
		}
	}
	function tarik_aksi($isi){
			$sqlstr="UPDATE konten_komentar SET status='off' WHERE id_komentar='".$isi['id_komentar']."'";
			$this->db->query($sqlstr);
	}
	function dorong_aksi($isi){
			$sqlstr="UPDATE konten_komentar SET status='on' WHERE id_komentar='".$isi['id_komentar']."'";
			$this->db->query($sqlstr);
	}

}
