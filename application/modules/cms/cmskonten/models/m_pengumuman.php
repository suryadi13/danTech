<?php
class M_pengumuman extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_pengumuman_aksi($isi){
		$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM konten WHERE komponen='".$isi['komponen']."'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;
//		$catatan=str_replace("/thumbs_","/",$isi['catatan']);
		$sqlstr="INSERT INTO konten (komponen,id_kategori,judul,sub_judul,id_penulis,tanggal,isi_konten,urutan)
		VALUES ('".$isi['komponen']."','".$isi['id_kategori']."','".$isi['judul']."','".$isi['sub_judul']."','".$isi['id_penulis']."','".$isi['tanggal']."','".$isi['isi_konteni']."','$max')";		
		$this->db->query($sqlstr);
	}

/*
    function edit_galeri_aksi($isi){

		$sqlstr="UPDATE konten SET judul='".$isi['judul']."',id_kategori='".$isi['id_kategori']."',isi_konten='".$isi['keterangan']."',tanggal='".$isi['tgl_buat']."' WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function hapus_galeri_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_konten='$isi'";
		$this->db->query($sqlstr);
	}


    function simpan_foto($id_galeri,$nama_file){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$id_galeri' AND komponen='galeri'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,foto,foto_thumbs,komponen,urutan_appe) 
		VALUES ('$id_galeri','$nama_file','thumbs_".$nama_file."','galeri','$max')";		
		$this->db->query($sqlstr);
	}

    function hapus_foto_aksi($isi){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konteni='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='".$isi['urutan']."'"; 
		$hslquery=$this->db->query($sqlstr);

		$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='".$isi['urutan']."'";
		$this->db->query($sqlstr);

		$sqlstr="UPDATE konten_appe SET urutan_appe=(urutan_appe-1) WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe>'".$isi['urutan']."'";
		$this->db->query($sqlstr);

		return $hslquery;
	}
    function edit_info_aksi($isi){
		for($i=0;$i<count($isi['judul_appe']);$i++){
				$sqlstr="UPDATE konten_appe SET
				 judul_appe='".$isi['judul_appe'][$i]."',
				 keterangan_appe='".$isi['keterangan_appe'][$i]."',
				 fotografer='".$isi['fotografer'][$i]."',
				 foto_from='".$isi['foto_from'][$i]."'
				 WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='".$isi['urutan'][$i]."'";
				$this->db->query($sqlstr);
		}
	}
    function reurut_foto_aksi($isi){
				$sqlstr="UPDATE konten_appe SET	 urutan_appe='99' WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='".$isi['urutan_ini']."'";
				$this->db->query($sqlstr);

				$sqlstr="UPDATE konten_appe SET	 urutan_appe='".$isi['urutan_ini']."' WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='".$isi['urutan_lawan']."'";
				$this->db->query($sqlstr);

				$sqlstr="UPDATE konten_appe SET	 urutan_appe='".$isi['urutan_lawan']."'	 WHERE id_konten='".$isi['idd']."' AND komponen='galeri' AND urutan_appe='99'";
				$this->db->query($sqlstr);
	}
*/
}
