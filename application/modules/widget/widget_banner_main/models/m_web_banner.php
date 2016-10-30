<?php
class M_web_banner extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($idw){
		$sqlstr3="SELECT * FROM konten_appe WHERE id_konten IN ($idw) AND tipe='banner'";
		$hslquery3=$this->db->query($sqlstr3)->result();

		return $hslquery3;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM konten_appe WHERE tipe='banner_judul'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
