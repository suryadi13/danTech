<?php
class M_agenda extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_agenda($idd){
		$sqlstr="SELECT a.*,c.nama_item AS nama_kategori,c.id_item AS id_kategori,c.id_parent,c.meta_value
		FROM konten a 
		LEFT JOIN (cmf_setting c)
		ON
		(c.id_setting='9' AND c.id_item=a.id_kategori)
		WHERE a.id_konten='$idd' AND a.komponen='agenda'";
		$hslquery=$this->db->query($sqlstr)->row();

		$jj = json_decode($hslquery->meta_value);
		$hslquery->id_kanal=$jj->id_kanal;
		return $hslquery;
	}
	function hitung_agenda($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_kategori='$path' AND komponen='agenda'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function urutan_agenda($idd,$path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE id_konten<='$idd' AND komponen='agenda' AND id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getagenda($mulai,$batas,$path){
		$sqlstr="SELECT a.*, b.nama_item AS nama_kategori,
		(SELECT foto FROM konten_appe WHERE id_konten=a.id_konten AND komponen='agenda' ORDER BY urutan_appe ASC LIMIT 0,1) AS foto
		FROM konten a
		LEFT JOIN (cmf_setting b) ON (a.id_kategori=b.id_item AND b.id_setting='9')
		WHERE a.id_kategori='$path' AND a.komponen='agenda'
		ORDER BY a.id_konten DESC  LIMIT $mulai,$batas";

		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
	function foto($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_konten='$idd'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function getfoto($idd){
		$sqlstr="SELECT * FROM konten_appe WHERE id_appe='$idd'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function c_tanggal($tgl){
		$sqlstr="SELECT DATE_FORMAT('$tgl','%d-%m-%Y') AS tanggal";
		$hslquery=$this->db->query($sqlstr)->row();
		return ($hslquery->tanggal);
	}
	function c_hari($tgl){
		$tanggal = date("Y-m-d", strtotime($tgl));
		$sqlstr="SELECT DAYNAME('$tanggal') AS hari";
		$hslquery=$this->db->query($sqlstr)->result();
		return ($hslquery[0]->hari);
	}
//////////////////////////////////////////////////////////////////////////////////
}
