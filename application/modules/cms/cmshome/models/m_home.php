<?php
class M_home extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getopsi(){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='1' ORDER BY urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->result();
		$ff=json_decode(@$hslqueryp[0]->meta_value);
		return $ff->nilai;
	}
	function iniopsi($idd){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function edit_text_aksi($ipp){
		$ini = $this->iniopsi($ipp['idd']);
			$jj = json_decode($ini[0]->meta_value);
		$label = $jj->label;
		$nilai = $jj->nilai;
		$tipe = $jj->tipe;

			$ini="{\"label\":\"".$label."\",\"nilai\":\"".$ipp['nama_kategori']."\",\"tipe\":\"".$tipe."\"}";
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$ipp['idd']."'";
			$this->db->query($sqlstr);
	}
    function simpan_file($idd,$nama){
		$ini = $this->iniopsi($idd);
			$jj = json_decode($ini[0]->meta_value);
		$label = $jj->label;
		$tipe = $jj->tipe;

			$ini="{\"label\":\"".$label."\",\"nilai\":\"".$nama."\",\"tipe\":\"".$tipe."\"}";
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$idd."'";
			$this->db->query($sqlstr);
	}




	function hitung_konten($path,$komp){
		if($path=="xx"){$and1=" WHERE komponen='$komp'";}else{$and1=" WHERE komponen='$komp' AND id_kategori='$path'";}
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function get_konten($mulai,$batas,$path,$komp){
		if($path=="xx"){$and1=" WHERE komponen='$komp'";}else{$and1=" WHERE komponen='$komp' AND id_kategori='$path'";}
		$sqlstr="SELECT * FROM konten  $and1 ORDER BY urutan DESC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function detail_konten($idd){
		$sqlstr="SELECT a.*,b.nama_item AS nama_kategori, DAYNAME(a.tanggal) AS hari,DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal
		FROM konten a 
		LEFT JOIN cmf_setting b ON (b.id_setting='9' AND a.id_kategori=b.id_item) 
		WHERE a.id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function foto_konten($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='foto' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function slider_konten($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='slider'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function lampiran_konten($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='lampiran' ORDER BY urutan_appe";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function get_penulis($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT a.id_item AS id_penulis, a.nama_item AS nama_penulis FROM cmf_setting a WHERE a.id_setting='6' ORDER BY a.urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_komponen($kat,$mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$iKat = ($kat=="all")?"":"  AND meta_value LIKE '%\"kategori\":\"ya\"%'";

		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='2' $iKat ORDER BY urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

	function get_kanal($idp){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='8' AND id_parent='$idp' ORDER BY urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function default_kanal(){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='7'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}


	function get_theme($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='4' ORDER BY urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function get_theme_admin($mulai,$batas){
		$limit = ($mulai=="all")?"":"  LIMIT $mulai,$batas";
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='3' ORDER BY urutan ASC $limit";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_rubrik($komponen,$mulai,$batas){
		$sqlstr="SELECT a.id_item AS id_kategori,a.nama_item AS nama_kategori,a.meta_value
		FROM cmf_setting a 
		WHERE a.id_setting='9' AND a.meta_value LIKE '%\"komponen\":\"$komponen\"%'
		ORDER BY a.urutan ASC 
		LIMIT $mulai,$batas"; 
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$id_kanal = @$jj->id_kanal;

				$sqlstrB="SELECT a.* FROM cmf_setting a WHERE id_item='$id_kanal'";
				$hslqueryB=$this->db->query($sqlstrB)->row();
				@$hslquery[$key]->nama_kanal = $hslqueryB->nama_item;
		}


		return $hslquery;
	}

	function detail_rubrik($idd){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND id_item='$idd'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function get_pilihanpolling($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE tipe='polling_pilihan' AND id_konten='$idd' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}



}
