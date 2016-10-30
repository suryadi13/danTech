<?php
class M_konten extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
    function hitung_konten($cari,$komponen,$idKat){
		if($idKat==""){	$iKat="";	} else {	$iKat="AND id_kategori='$idKat'";}
		$sqlstr="SELECT COUNT(a.id_konten) AS numrows
		FROM (konten a)
		WHERE  (
		a.komponen='$komponen'
		AND a.judul LIKE '%$cari%'
		$iKat
		)
		";
		$query = $this->db->query($sqlstr)->row(); 
		return $query->numrows;
	}
	function get_konten($cari,$mulai,$batas,$komponen,$idKat){
		if($idKat==""){	$iKat="";	} else {	$iKat="AND a.id_kategori='$idKat'";}
		$sqlstr="SELECT a.id_konten,a.judul,a.sub_judul,(SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal, b.nama_item AS nama_kategori
		FROM konten a
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9') 
		WHERE  (
		a.komponen='$komponen'
		AND a.judul LIKE '%$cari%'
		$iKat
		)
		ORDER BY a.urutan DESC
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_konten($idd){
		$sqlstr="SELECT a.id_konten,a.judul,a.sub_judul,DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal FROM konten a WHERE  id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
	function ini_item($idd){
		$sqlstr="SELECT a.* FROM cmf_setting a WHERE  id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
    function tambah_aksi($isi){
		$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM konten WHERE komponen='".$isi['komponen']."'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;
		$tanggal = date("Y-m-d", strtotime($isi['tanggal']));
//		$catatan=str_replace("/thumbs_","/",$isi['catatan']);
		$sqlstr="INSERT INTO konten (komponen,id_kategori,judul,sub_judul,id_penulis,tanggal,isi_konten,urutan)
		VALUES ('".$isi['komponen']."','".$isi['id_kategori']."','".$isi['judul']."','".$isi['sub_judul']."','".$isi['id_penulis']."','$tanggal','".$isi['isi_konteni']."','$max')";		
		$this->db->query($sqlstr);
	}
    function edit_aksi($isi){
		$tanggal = date("Y-m-d", strtotime($isi['tanggal']));
		$sqlstr="UPDATE konten SET 
		judul='".$isi['judul']."',
		sub_judul='".$isi['sub_judul']."',
		id_penulis='".$isi['id_penulis']."',
		id_kategori='".$isi['id_kategori']."',
		tanggal='".$tanggal."',
		isi_konten='".$isi['isi_konteni']."'
		WHERE
		id_konten='".$isi['id_konten']."'";
		$this->db->query($sqlstr);
	}
    function hapus_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_konten='".$isi['id_konten']."'";
		$this->db->query($sqlstr);
	}


//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
	function simpan_foto($idd,$nama,$komponen){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$idd' AND tipe='foto'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,tipe,foto,urutan_appe) 
		VALUES ('$idd','foto','$nama','$max')";		
		$this->db->query($sqlstr);
	}
    function hapus_foto_aksi($isi){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."' AND tipe='".$isi['tipe']."'"; 
		$hslquery=$this->db->query($sqlstr);

		$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."' AND tipe='".$isi['tipe']."'";
		$this->db->query($sqlstr);

		$sqlstr="UPDATE konten_appe SET urutan_appe=(urutan_appe-1) WHERE id_konten='".$isi['idd']."' AND urutan_appe>'".$isi['urutan']."' AND tipe='".$isi['tipe']."'";
		$this->db->query($sqlstr);

		return $hslquery;
	}
    function ket_foto($isi){
//		$sqlstr="UPDATE konten_appe SET ".$isi['kolom']."='".$isi['isian']."' WHERE id_konten='".$isi['idd']."' AND urutan_appe='".$isi['urutan']."' AND tipe='".$isi['tipe']."'";
		$sqlstr="UPDATE konten_appe SET ".$isi['kolom']."='".$isi['isian']."' WHERE id_appe='".$isi['idd']."'";
		$this->db->query($sqlstr);
	}
//////////////////////////////////////////////////////////////////////////////////
	function simpan_lampiran($idd,$nama,$komponen){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$idd' AND tipe='lampiran'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,tipe,foto,urutan_appe) 
		VALUES ('$idd','lampiran','$nama','$max')";		
		$this->db->query($sqlstr);
	}
//////////////////////////////////////////////////////////////////////////////////
	function simpan_slider($idd,$nama,$komponen){
		$query=$this->db->query("SELECT MAX(urutan_appe) as count_nik FROM konten_appe WHERE id_konten='$idd' AND tipe='slider'"); 
		$row = $query->row_array();		$max = $row['count_nik']+1;

		$sqlstr="INSERT INTO konten_appe (id_konten,tipe,foto,urutan_appe) 
		VALUES ('$idd','slider','$nama','$max')";		
		$this->db->query($sqlstr);
	}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
	function hitung_sekilasinfo($path,$komp){
		if($path=="xx"){$and1=" WHERE tipe='$komp'";}else{$and1=" WHERE tipe='$komp' AND id_konten='$path'";}
		$query=$this->db->query("SELECT count(id_appe) as count_nik FROM konten_appe $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function get_sekilasinfo($mulai,$batas,$path,$komp){
		if($path=="xx"){$and1=" WHERE tipe='$komp'";}else{$and1=" WHERE tipe='$komp' AND id_konten='$path'";}
		$sqlstr="SELECT * FROM konten_appe  $and1 ORDER BY urutan_appe DESC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);

		return $hslquery;
	}
	function hitung_album(){
		$query=$this->db->query("SELECT count(a.id_item) as count_nik
		FROM cmf_setting a 
		WHERE a.id_setting='6' AND a.meta_value LIKE '%\"komponen\":\"banner\"%'");
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getalbum($mulai,$batas){
		$sqlstr="SELECT a.id_item AS id_kategori,a.nama_item AS nama_kategori,a.meta_value
		FROM cmf_setting a 
		WHERE a.id_setting='6' AND a.meta_value LIKE '%\"komponen\":\"banner\"%'
		ORDER BY a.urutan ASC  
		LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function isi_album($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd' AND tipe='banner'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function cek_wrapper($id_kategori){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND (meta_value LIKE '%\"id_kategori\":\"$id_kategori\"%' OR meta_value LIKE '%\"id_kategori\":\"$id_kategori,%' OR meta_value LIKE '%,$id_kategori\"%' OR meta_value LIKE '%,$id_kategori,%' )";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function get_kategori($komponen){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE  a.id_setting='9' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		$ff=array();
		foreach($hslquery AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$ff[$key]->kategori = $val->nama_item;
			@$ff[$key]->id_kategori = $val->id_item;
			@$id_kanal = @$jj->id_kanal;

				$sqlstrB="SELECT a.* FROM cmf_setting a WHERE id_item='$id_kanal'";
				$hslqueryB=$this->db->query($sqlstrB)->row();
				@$ff[$key]->nama_kanal = $hslqueryB->nama_item;
		}
		return $ff;
	}
    function get_komponen(){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE  a.id_setting='2' ORDER BY urutan";
		$hslquery=$this->db->query($sqlstr)->result();
		$ff=array();
		foreach($hslquery AS $key=>$val){
			$jj = json_decode($val->meta_value);
			@$ff[$key]->id_komponen = $val->id_item;
			@$ff[$key]->komponen = $val->nama_item;
			@$ff[$key]->label = $jj->label;
		}

		return $ff;
	}
//////////////////////////////////////////////////////////////////////////////////
////////////////////////////DIREKTORI/////////////////////////////////////////////
	function detail_kategori($idd){
		$hslquery = $this->db->get_where('cmf_setting', array('id_item' => $idd));
		return $hslquery->result();
	}
	function getlabel($kategori){
		$sqlstr="SELECT *
		FROM konten_appe 
		WHERE tipe='atribut_direktori' AND id_konten='$kategori'
		ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function reurut_atribut_aksi($isi){
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_lawan']."' WHERE id_appe='".$isi['id_ini']."'";
		$this->db->query($sqlstr);
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_ini']."' WHERE id_appe='".$isi['id_lawan']."'";
		$this->db->query($sqlstr);
	}



}
