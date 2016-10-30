<?php
class M_theme extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function gettheme(){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE a.id_setting='4' ORDER BY a.id_item";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_theme($path){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting IN (7,8) AND meta_value LIKE '%\"theme\":\"$path\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}

    function hapus_item_aksi($idp,$ids){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idp'";
		$this->db->query($sqlstr);
		$this->reurut($ids);
	}
    function reurut($ids){
		$sqlstr="SELECT id_item FROM cmf_setting WHERE id_setting='$ids' ORDER BY id_item";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$sqlstr="UPDATE cmf_setting SET urutan='".($key+1)."' WHERE id_item='".$val->id_item."'";
			$this->db->query($sqlstr);
		}
	}
	function edit_aksi($isi){
			$ini="{\"theme_path\":\"".$isi['theme_path']."\",\"keterangan\":\"".$isi['keterangan']."\",\"status\":\"on\"}";
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$isi['idd']."'";
			$this->db->query($sqlstr);
	}
	function getadminpanel(){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE a.id_setting='3' ORDER BY a.id_item";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_admin($path){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='13' AND meta_value LIKE '%\"section_name\":\"$path\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function admin_tambah_aksi($isi,$ids){
			$sqa = "SELECT MAX(urutan) as count_nik FROM cmf_setting WHERE id_setting='$ids'"; 
			$hsla = $this->db->query($sqa)->row();		$max = $hsla->count_nik+1;

			$sqlstrA="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='$ids'";
			$hslqueryA = $this->db->query($sqlstrA)->row();	$maxidA = $hslqueryA->maxid+1;

			$ini="{\"theme_path\":\"".$isi['theme_path']."\",\"keterangan\":\"".$isi['keterangan']."\",\"status\":\"on\"}";
			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,nama_item,urutan,meta_value) 
			VALUES ('$maxidA','$ids','".$isi['theme_name']."','$max','$ini')";
			$this->db->query($sqlstr);
	}
	function admin_edit_aksi($isi){
			$ini="{\"theme_path\":\"".$isi['theme_path']."\",\"keterangan\":\"".$isi['keterangan']."\",\"status\":\"on\"}";
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$isi['idd']."'";
			$this->db->query($sqlstr);
	}
}
