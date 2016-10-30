<?php
class M_galeri extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_galeri_aksi($isi){
		$tanggal = date("Y-m-d", strtotime($isi['tgl_buat']));
		$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM konten WHERE id_kategori='".$isi['id_kategori']."' AND komponen='galeri'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten (judul,id_kategori,tanggal,isi_konten,urutan,komponen) 
		VALUES ('".$isi['judul']."','".$isi['id_kategori']."','$tanggal','".$isi['keterangan']."','$max','galeri')";		
		$this->db->query($sqlstr);

		$sqlstr="SELECT id_konten FROM konten WHERE id_kategori='".$isi['id_kategori']."' AND urutan='$max'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery[0];
	}
    function edit_galeri_aksi($isi){
		$tanggal = date("Y-m-d", strtotime($isi['tgl_buat']));
		$sqlstr="UPDATE konten SET judul='".$isi['judul']."',id_kategori='".$isi['id_kategori']."',isi_konten='".$isi['keterangan']."',tanggal='$tanggal' WHERE id_konten='".$isi['idd']."'";
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

}
