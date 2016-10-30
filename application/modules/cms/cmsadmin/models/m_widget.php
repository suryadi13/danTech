<?php
class M_widget extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget(){
		$sqlstr="SELECT a.*
		FROM cmf_setting a 
		WHERE a.id_setting='5' 
		ORDER BY a.id_item";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_widget($usn){
		$this->db->select('id_item');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','11');
		$this->db->like('meta_value','\"id_widget\":\"'.$usn.'\"');
		$hslquery = $this->db->get()->result();

		return $hslquery;

	}

    function tambah_widget_aksi($ipp){
			$meta = "{\"lokasi_widget\":\"".$ipp['lokasi']."\",\"keterangan\":\"".$ipp['keterangan']."\"}";
			$sqlstr="INSERT INTO cmf_setting (id_setting,nama_item,meta_value) 
			VALUES ('5','".$ipp['nama_widget']."','".$meta."')";		
			$this->db->query($sqlstr);
			$hasil = "sukses";
		return $hasil;
	}
    function edit_widget_aksi($idw,$ipp){
			$meta = "{\"lokasi_widget\":\"".$ipp['lokasi']."\",\"keterangan\":\"".$ipp['keterangan']."\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_widget']."',meta_value='$meta' WHERE id_item='$idw'";		
			$this->db->query($sqlstr);
			$hasil = "sukses";
		return $hasil;
	}
    function hapus_widget_aksi($idg){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idg'";
		$this->db->query($sqlstr);
	}

    function detail_widget($idd){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery;
	}


}
