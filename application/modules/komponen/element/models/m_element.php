<?php
class M_element extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function cari_rubrik_kanal($id_kanal){
		$sqlstr="SELECT a.nama_item AS nama_kategori,a.id_item AS id_kategori,a.meta_value
		FROM cmf_setting a 
		WHERE a.id_setting='9' AND a.meta_value LIKE '%\"id_kanal\":\"$id_kanal\"%' AND a.meta_value LIKE '%\"status\":\"publish\"%'
		ORDER BY a.urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();

		foreach($hslquery AS $key=>$val){
			$jj = json_decode($val->meta_value);
			$hslquery[$key]->id_kanal=$jj->id_kanal;
			$hslquery[$key]->komponen=$jj->komponen;
		}

		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function gambar_artikel($idd){
		$hslquery = $this->db->get_where('konten_appe', array('id_konten' => $idd,'tipe'=>'foto'))->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function lampiran_artikel($idd){
		$hslquery = $this->db->get_where('konten_appe', array('id_konten' => $idd,'tipe'=>'lampiran'))->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function hitung_komen($path){
		$query=$this->db->query("SELECT count(id_komentar) as count_nik FROM konten_komentar WHERE id_konten='$path' AND id_induk='0' AND status='on'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getkomen($mulai,$batas,$isi){
		$sqlstr="SELECT * FROM konten_komentar WHERE id_konten='$isi' AND id_induk='0' AND status='on' ORDER BY tanggal_komentar DESC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_jawaban($idd){
		$sqlstr="SELECT a.* FROM konten_komentar a WHERE  id_induk='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function isi_komentar_aksi($isi,$ipp){
		$sekarang = date('Y-m-d H:i:s');
		$sqlstr="INSERT INTO konten_komentar (id_konten,nama_komentator,email_komentator,isi_komentar,tanggal_komentar,ip_adress) 
		VALUES ('".$isi['id_konten']."','".$isi['nama_komentator']."','".$isi['email_komentator']."','".$isi['isi_komentar']."','$sekarang','$ipp')";		
		$this->db->query($sqlstr);
	}
//////////////////////////////////////////////////////////////////////////////////
}
