<?php
class M_web extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->result();
		$ff=json_decode(@$hslqueryp[0]->meta_value);
		return $ff->nilai;
	}

	function getwrapper($path,$posisi){
		$this->db->select('meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','11');
		$this->db->where('nama_item',$posisi);
		$this->db->like('meta_value','\"path_kanal\":\"'.$path.'\"');
		$hslquery = $this->db->get()->row();
/*
		$sqlstr="SELECT meta_value
		FROM cmf_setting 
		WHERE id_setting='10' AND nama_item='$posisi' AND meta_value LIKE '%\"path_kanal\":\"$path\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
*/
		$res=(!empty($hslquery->meta_value))	?	json_decode($hslquery->meta_value)	:	json_decode("{\"widget\":[]}");
		return $res;
	}

	function carikanal($idd){
/*
		$this->db->select('meta_value,nama_item,id_item,urutan');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','1');
		$this->db->like('meta_value','\"path_kanal\":\"'.$idd.'\"');
		$hslquery = $this->db->get()->row();
*/
		$sqlstr="SELECT meta_value,nama_item,id_item,urutan
		FROM cmf_setting 
		WHERE id_setting='8' AND meta_value LIKE '%\"path_kanal\":\"$idd\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
					@$hsl = json_decode($hslquery->meta_value);
					@$hslq->nama_kanal=$hslquery->nama_item;
					$hslq->path_kanal=@$hsl->path_root;
					$hslq->tipe=@$hsl->tipe;
					$hslq->theme=@$hsl->theme;
					$hslq->id_kanal=@$hslquery->id_item;
					$hslq->urutan=@$hslquery->urutan;
					return $hslq;
	}

	function get_komponen(){
//		$hslquery = $this->db->get_where('cmf_setting', array('id_setting' => '2'))->result();
		$sqlstr="SELECT *
		FROM cmf_setting 
		WHERE id_setting='2'";
		$hslquery=$this->db->query($sqlstr)->result();

		$hsl = array();
		foreach ($hslquery AS $key=>$val){ $hsl[]=$val->nama_item;}
		return $hsl;
	}

    function counter($idd){
		$sqlstr="UPDATE konten SET baca=(baca+1) WHERE id_konten='$idd'";
		$this->db->query($sqlstr);
	}

	function root_kanal($idd){
		$root="";
		$sqlstr="SELECT a.id_item AS id_kanal,a.nama_item AS nama_kanal,a.id_parent AS id_parent,a.urutan AS urutan,a.meta_value
		FROM cmf_setting a 
		WHERE a.id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();

		$jj = json_decode($hslquery->meta_value);
		$hslquery->kanal_path=$jj->path_kanal;

		$root=$hslquery->id_kanal."*".$hslquery->nama_kanal."*".$hslquery->kanal_path."**".$root;
		if($hslquery->id_parent!=0){
			$ulang = $this->root_kanal($hslquery->id_parent);
			$root=$ulang.$root;
		}
		return $root;
	}
	function defaultkanal(){
		$sqlstr="SELECT a.id_item AS id_kanal,a.nama_item AS nama_kanal,a.meta_value FROM cmf_setting a WHERE a.id_setting='7'";
		$hslquery=$this->db->query($sqlstr)->row();

		$jj = json_decode($hslquery->meta_value);
		$hslquery->path_kanal=$jj->path_kanal;
		$hslquery->tipe=$jj->tipe;
		$hslquery->theme=$jj->theme;
		return $hslquery;
	}
	function cari_kanal($idd){
		$sqlstr="SELECT a.id_item AS id_kanal,a.nama_item AS nama_kanal,a.id_parent AS id_parent,a.urutan AS urutan,a.meta_value
		FROM cmf_setting a 
		WHERE a.id_item='$idd'";

		$hslquery=$this->db->query($sqlstr)->row();

		$jj = json_decode($hslquery->meta_value);
		$hslquery->kanal_path=$jj->path_kanal;
		$hslquery->tipe=$jj->tipe;
		$hslquery->theme=$jj->theme;

		if($hslquery->id_parent==0){
			return $hslquery;
		} else {
			$ulang=$this->cari_kanal($hslquery->id_parent);
			return $ulang;
		}
	}
	function ikanal($idd){
		$hslquery = $this->db->get_where('cmf_setting', array('id_setting' => '9','id_item' => $idd))->row();
			$jj = json_decode($hslquery->meta_value);
			@$hslquery->id_kanal=$jj->id_kanal;
		return $hslquery;
	}


}
