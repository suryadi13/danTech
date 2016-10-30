<?php
class M_infoslider extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget($ini,$batas){
		$sqlstr3="SELECT * 
		FROM konten_appe
		WHERE id_appe IN ($ini) LIMIT 0,$batas";
		$hslquery3=$this->db->query($sqlstr3)->result();

		return $hslquery3;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM konten_appe WHERE tipe='$komponen'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
