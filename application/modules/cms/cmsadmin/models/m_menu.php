<?php
class M_menu extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function detail_grup($idg){
		$sqlstr="SELECT nama_item AS group_name FROM cmf_setting WHERE id_item='$idg'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////

	function getitem($sett,$idp){
		$sqlstr="SELECT a.*
		FROM cmf_setting a 
		WHERE a.id_setting='$sett' AND a.id_parent='$idp' 
		ORDER BY a.urutan";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function ini_item($nid){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='".$nid."'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function hapus_item_aksi($idp){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idp'";
		$this->db->query($sqlstr);
	}
    function reurut($ids,$idp){
		$sqlstr="SELECT id_item FROM cmf_setting WHERE id_setting='$ids' AND id_parent='$idp' ORDER BY urutan";
		$hslquery=$this->db->query($sqlstr)->result();
		$urutanbaru=1;
		foreach($hslquery AS $key=>$val){
			$sqlstr="UPDATE cmf_setting SET urutan='$urutanbaru' WHERE id_item='".$val->id_item."'";
			$this->db->query($sqlstr);
			$urutanbaru++;
		}
	}

///////////////////////////////////////////////////
	function tambah_menu_aksi($idp,$ipp){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='12'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = $hslquery->maxid+1;

			$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM cmf_setting WHERE id_setting='12' AND id_parent='$idp'"); 
			$row = $query->row_array();		$max = $row['count_nik']+1;
			$ini="{\"path_menu\":\"".$ipp['menu_path']."\",\"icon_menu\":\"".$ipp['icon_menu']."\",\"keterangan\":\"".$ipp['keterangan']."\"}";

			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,id_parent,nama_item,urutan,meta_value) 
			VALUES ('$maxid','12','$idp','".$ipp['menu_name']."','$max','$ini')";		
			$this->db->query($sqlstr);
	}
	function edit_menu_aksi($idp,$ipp){
			$ini="{\"path_menu\":\"".$ipp['menu_path']."\",\"icon_menu\":\"".$ipp['icon_menu']."\",\"keterangan\":\"".$ipp['keterangan']."\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['menu_name']."',meta_value='$ini' WHERE id_item='$idp'";		
			$this->db->query($sqlstr);
	}
	function cek_menu($idp){
		$sqlstr="SELECT id_item FROM cmf_setting WHERE id_setting='14' AND meta_value LIKE '%\"id_menu\":\"$idp\"%'";
		$hslquery=$this->db->query($sqlstr)->result();

		return $hslquery;
	}

	function getmenupengguna($sett,$sett_ref,$idp,$group_id){
		$sqlstr="SELECT a.* FROM cmf_setting a WHERE a.id_setting='$sett_ref' AND a.id_parent='$idp' ORDER BY a.urutan";
		$hslquery=$this->db->query($sqlstr)->result();
		
		$hslqueryc=array();
		foreach($hslquery as $key=>$val){
			$sqlstrb="SELECT b.* FROM cmf_setting b WHERE b.id_setting='$sett' AND b.meta_value LIKE '%\"group_id\":\"$group_id\"%'  AND b.meta_value LIKE '%\"id_menu\":\"".$val->id_item."\"%'";
			$hslqueryb=$this->db->query($sqlstrb)->result();
			if(!empty($hslqueryb)){	$hslqueryc[]=$hslquery[$key];	}
		}
		return $hslqueryc;
	}
	function cekmenupengguna($id_item,$set,$set_ref,$grup){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE a.id_setting='$set_ref' AND a.id_item='$id_item'";
		$hslquery=$this->db->query($sqlstr)->result();
		$sqlstrb="SELECT a.id_item FROM cmf_setting a WHERE a.id_setting='$set' AND a.meta_value LIKE '%\"group_id\":\"$grup\"%' AND a.meta_value LIKE '%\"id_menu\":\"$id_item\"%'";
		$hslqueryb=$this->db->query($sqlstrb)->result();
		return $hslqueryb;
	}
	function tambah_menu_pengguna_aksi($idd,$set,$ipp){
		for($i=0;$i<count($ipp)-1;$i++){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='$set'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = $hslquery->maxid+1;

			$sql ="SELECT id_item FROM cmf_setting WHERE id_setting='$set' AND meta_value LIKE '%\"group_id\":\"$idd\"%' AND meta_value LIKE '%\"id_menu\":\"".$ipp[$i]."\"%'";
			$dt = $this->db->query($sql)->result();
			if(empty($dt)){	
				$ini="{\"id_menu\":\"".$ipp[$i]."\",\"group_id\":\"$idd\"}";
				$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,meta_value) VALUES ('$maxid','$set','$ini')";
				$this->db->query($sqlstr);
			}
		}
	}
//////////////////////////////////////////////////////////////////////////////////
    function naik_index($id_ini,$id_lawan,$urutan_ini,$urutan_lawan){
		$sqlstr="UPDATE cmf_setting SET urutan='$urutan_lawan' WHERE id_item='$id_ini'";
		$this->db->query($sqlstr);
		$sqlstr="UPDATE cmf_setting SET urutan='$urutan_ini' WHERE id_item='$id_lawan'";
		$this->db->query($sqlstr);
	}	
//////////////////////////////////////////////////////////////////////////////////


}
