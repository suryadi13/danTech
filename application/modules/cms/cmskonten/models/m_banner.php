<?php
class M_banner extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_album(){
		$query=$this->db->query("SELECT count(a.id_appe) as count_nik
		FROM konten_appe a 
		WHERE a.tipe='banner_judul'");
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getalbum($mulai,$batas){
		$sqlstr="SELECT a.id_appe AS id_kategori,a.judul_appe AS nama_kategori
		FROM konten_appe a 
		WHERE a.tipe='banner_judul'
		ORDER BY a.urutan_appe ASC  
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function isi_album($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='banner' ORDER BY urutan_appe";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function inialbum($idd){
		$sqlstr="SELECT judul_appe AS nama_kategori,keterangan_appe AS keterangan FROM konten_appe WHERE id_appe='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
    function tambah_album_aksi($isi){
			$sqlstr="INSERT INTO konten_appe (judul_appe,keterangan_appe,tipe) VALUES ('".$isi['nama_kategori']."','".$isi['keterangan']."','banner_judul')";		
			$this->db->query($sqlstr);
	}
    function edit_album_aksi($isi){
			$sqlstr="UPDATE konten_appe SET judul_appe='".$isi['nama_kategori']."',keterangan_appe='".$isi['keterangan']."' WHERE id_appe='".$isi['idd']."'";		
			$this->db->query($sqlstr);
	}
    function hapus_album_aksi($isi){
			$sqlstr="DELETE FROM konten_appe WHERE id_appe='".$isi['idd']."'";		
			$this->db->query($sqlstr);
	}

	function banner($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='banner' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function simpan_banner($id_kategori,$nama_file){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$id_kategori' AND tipe='banner'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,foto,urutan_appe,tipe) 
		VALUES ('$id_kategori','$nama_file','$max','banner')";		
		$this->db->query($sqlstr);
	}

    function hapus_banner_aksi($isi){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."' AND tipe='banner' ORDER BY urutan_appe ASC"; 
		$hslquery=$this->db->query($sqlstr);

		$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$isi['idd']."' AND tipe='banner' AND urutan_appe='".$isi['urutan']."'";
		$this->db->query($sqlstr);

		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='".$isi['idd']."' AND tipe='banner' ORDER BY urutan_appe ASC"; 
		$vg=$this->db->query($sqlstr)->result();
		foreach($vg AS $key=>$val){
			$sqlstr="UPDATE konten_appe SET urutan_appe='".($key+1)."' WHERE id_appe='".$val->id_appe."'";
			$this->db->query($sqlstr);
		}

		return $hslquery;
	}
    function reurut_banner_aksi($isi){
				$sqlstr="UPDATE konten_appe SET	urutan_appe='99' WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan_ini']."'";
				$this->db->query($sqlstr);

				$sqlstr="UPDATE konten_appe SET	urutan_appe='".$isi['urutan_ini']."' WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan_lawan']."'";
				$this->db->query($sqlstr);

				$sqlstr="UPDATE konten_appe SET	urutan_appe='".$isi['urutan_lawan']."'	WHERE id_konten='".$isi['idd']."' AND urutan_appe='99'";
				$this->db->query($sqlstr);
	}

	function cek_wrapper($id_kategori){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND (meta_value LIKE '%\"id_kategori\":\"$id_kategori\"%' OR meta_value LIKE '%\"id_kategori\":\"$id_kategori,%' OR meta_value LIKE '%,$id_kategori\"%' OR meta_value LIKE '%,$id_kategori,%' )";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function isi_link($isi){
				$sqlstr="UPDATE konten_appe SET
				 link='".$isi['isian']."'
				 WHERE tipe='banner' AND id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."'";
				$this->db->query($sqlstr);
	}
    function hapus_link($isi){
				$sqlstr="UPDATE konten_appe SET
				 link=''
				 WHERE tipe='banner' AND id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."'";
				$this->db->query($sqlstr);
	}


//////////////////////////////////////////////////////////////////////////////////

}
