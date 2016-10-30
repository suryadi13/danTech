<?php
class M_polling extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_aksi($isi){
		$sqlstr="INSERT INTO konten (judul,komponen,id_kategori,isi_konten) 
		VALUES ('".$isi['judul']."','polling','".$isi['id_kategori']."','".$isi['isi']."')";		
		$this->db->query($sqlstr);
	}
    function edit_aksi($isi){
		$sqlstr="UPDATE konten SET judul='".$isi['judul']."',id_kategori='".$isi['id_kategori']."',isi_konten='".$isi['isi']."' WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function hapus_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
		$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
    function get_pilihan($isi){
		$sqlstr="SELECT * FROM konten_appe WHERE tipe='polling_pilihan' AND id_konten='$isi' ORDER BY urutan_appe ASC";
		$this->db->query($sqlstr);
	}
    function tambah_pilihan_aksi($isi){
		$jml=count($isi['pilihan']); 
		for($i=0;$i<$jml;$i++){
				$sqlstr="INSERT INTO konten_appe (judul_appe,tipe,id_konten,urutan_appe) 
				VALUES ('".$isi['pilihan'][$i]."','polling_pilihan','".$isi['idd']."','".($i+1)."')";		
				$this->db->query($sqlstr);
		}
	}
    function edit_pilihan_aksi($isi){
		$jml=count($isi['label']); 
		for($i=0;$i<$jml;$i++){
			$sqlstr="UPDATE konten_appe SET judul_appe='".$isi['label'][$i]."' WHERE id_appe='".$isi['id_label'][$i]."'";
			$this->db->query($sqlstr);
		}
	}
    function reurut_pilihan_aksi($isi){
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_lawan']."' WHERE id_appe='".$isi['id_ini']."'";
		$this->db->query($sqlstr);
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_ini']."' WHERE id_appe='".$isi['id_lawan']."'";
		$this->db->query($sqlstr);
	}
    function tambah_pilihan_satu_aksi($isi){
				$sqlstr="INSERT INTO konten_appe (judul_appe,tipe,id_konten,urutan_appe) 
				VALUES ('".$isi['label']."','polling_pilihan','".$isi['idd']."','".$isi['urutan']."')";		
				$this->db->query($sqlstr);
	}
    function hapus_pilihan_aksi($isi){
		$sqlstr="DELETE FROM konten_appe WHERE id_appe='".$isi['id_atr']."'";
		$this->db->query($sqlstr);

		$sqlstr="SELECT * FROM konten_appe  WHERE tipe='polling_pilihan' AND id_konten='".$isi['id_kat']."' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->set('urutan_appe',($key+1));
			$this->db->where('id_appe',$val->id_appe);
			$this->db->update('konten_appe');
		}

	}


//////////////////////////////////////////////////////////////////////////////////
}
