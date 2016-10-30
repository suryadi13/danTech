<?php
class M_widget_statis extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function getwidget($idd,$ini){
		$sqlstr3="SELECT a.*
		FROM konten a 
		WHERE a.id_konten IN ($ini) LIMIT 0,1";
		$hslquery3=$this->db->query($sqlstr3)->result();

		return $hslquery3;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM konten WHERE komponen='$komponen'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////
}
