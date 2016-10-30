<?php
class M_web_var extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function get_var_header($idd){
		$sqlstr="SELECT a.nama_item,a.meta_value,b.meta_value AS mtt
		FROM cmf_setting a 
		LEFT JOIN cmf_setting b ON b.id_item='$idd'
		WHERE a.id_setting='10' AND a.meta_value LIKE '%\"id_kanal\":\"$idd\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}

	function gettemplate_by_path($path){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='4' AND meta_value LIKE '%\"theme_path\":\"$path\"%' ";
		$data = $this->db->query($sqlstr)->result();
		return $data;
	}

	function getkanal_on($idd){
		$sqlstr="SELECT id_item AS id_kanal, nama_item AS nama_kanal, id_parent,urutan,meta_value FROM cmf_setting a 
		WHERE a.id_setting='8' 
		AND a.id_parent='$idd' 
		AND a.meta_value LIKE '%\"status\":\"on\"%'  
		AND a.meta_value LIKE '%\"tipe\":\"biasa\"%' 
		ORDER BY a.urutan ASC";
		$hslquery = $this->db->query($sqlstr)->result();
		return $hslquery;
	}


}
