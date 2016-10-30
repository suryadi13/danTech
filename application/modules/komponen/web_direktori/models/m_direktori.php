<?php
class M_direktori extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function getdirektori($mulai,$batas,$ini){
		$sqlstr="SELECT a.*,b.nama_item AS nama_kategori,  
		(SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND komponen='direktori' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto
		FROM konten a 
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item)
		WHERE a.id_kategori='$ini' AND a.komponen='direktori' 
		ORDER BY a.urutan ASC LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}

	function hitung_direktori($path){
		$this->db->select('id_konten');
		$this->db->from('konten');
		$this->db->where('id_kategori',$path);
		$hslquery['count'] = count($this->db->get()->result());
		
		return $hslquery;
	}

	function urutan_direktori($idd,$path){
		$this->db->select('id_konten');
		$this->db->from('konten');
		$this->db->where('id_kategori',$path);
		$this->db->where('urutan<=',$idd,FALSE);
		$hslrow['count'] = count($this->db->get()->result());
		return $hslrow;
	}

	function ini_direktori($idd){
		$sqlstr="SELECT a.*, (SELECT DAYNAME(a.tanggal)) AS hari, DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,c.nama_item AS nama_kategori,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='9' AND c.id_item=a.id_kategori)
		WHERE a.id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		$jj = json_decode($hslquery->meta_value);
		$hslquery->id_kanal=$jj->id_kanal;

		return $hslquery;
	}

	function getlabel($kategori){
/*
		$sqlstr="SELECT *
		FROM cmf_setting 
		WHERE id_setting='15' AND id_parent='$kategori'
		ORDER BY urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
*/
		$sqlstr="SELECT *
		FROM konten_appe 
		WHERE tipe='atribut_direktori' AND id_konten='$kategori'
		ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;

	}
	function nama_rubrik($path){
		$qry = "SELECT nama_item FROM cmf_setting WHERE id_item='$path'"; 
		$hsl = $this->db->query($qry)->row();
		$nama = $hsl->nama_item;
		return $nama;
	}


}
