<?php
class M_user extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getuser($mulai,$batas,$path){
		if($path=="xx"){$and1="";}else{$and1=" WHERE a.group_id='$path'";}
		$sqlstr="SELECT a.*,b.nama_item AS group_name FROM users a LEFT JOIN (cmf_setting b) ON (a.group_id=b.id_item) $and1 ORDER BY b.id_item ASC,a.user_id ASC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function hitung_user($path){
		if($path=="xx"){$and1="";}else{$and1=" WHERE group_id='$path'";}

		$query=$this->db->query("SELECT count(user_id) as count_nik FROM users $and1"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
    function detail_user($idd){
		$sqlstr="SELECT * FROM users WHERE user_id='$idd'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function cek_user($usn){
		$sqlstr="SELECT * FROM users WHERE username='$usn'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function tambah_user_aksi($ipp){
		$cek = $this->cek_user($ipp['user_name']);
		if(empty($cek)){
			$sqlstr="INSERT INTO users (group_id,username,nama_user,passwd) 
			VALUES ('".$ipp['group_id']."','".$ipp['user_name']."','".$ipp['nm_pengguna']."','".sha1($ipp['user_name'])."')";		
			$this->db->query($sqlstr);
			$hasil = "sukses";
		} else {
			$hasil = "gagal";
		}
		return $hasil;
	}
    function edit_user_aksi($idg,$ipp){
		$cek = $this->cek_user($ipp['user_name']);
		if(!empty($cek) && $cek[0]->user_id!=$idg){
			$hasil = "gagal";
		} else {
			$sqlstr="UPDATE users SET group_id='".$ipp['group_id']."',username='".$ipp['user_name']."',nama_user='".$ipp['nm_pengguna']."' WHERE user_id='$idg'";
			$this->db->query($sqlstr);
			$hasil = "sukses";
		}
		return $hasil;
	}
    function hapus_user_aksi($idg){
		$sqlstr="DELETE FROM users WHERE user_id='$idg'";
		$this->db->query($sqlstr);
	}
	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->result();
		$ff=json_decode(@$hslqueryp[0]->meta_value);
		return $ff->nilai;
	}
//////////////////////////////////////////////////////////////////////////////////
	function getusergroup(){
		$sqlstr="SELECT id_item AS group_id,nama_item AS group_name,meta_value FROM cmf_setting WHERE id_setting='13' ORDER BY id_item ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$jj = json_decode($val->meta_value);
			$theme = $jj->section_name;
			$sqlstr2="SELECT nama_item FROM cmf_setting WHERE id_setting='3' AND meta_value LIKE '%\"theme_path\":\"".$theme."\"%'";
			$hslquery2=$this->db->query($sqlstr2)->row();
			$hslquery[$key]->theme = $hslquery2->nama_item;
		}
		return $hslquery;
	}
	function cek_grup($idg){
		$sqlstr="SELECT user_id FROM users WHERE group_id='$idg'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
	function detail_grup($idg){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='$idg'";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
    function tambah_grup_aksi($ipp){
		$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='13'";
		$hslquery=$this->db->query($sqlstr)->row();
		$maxid = $hslquery->maxid+1;

		$ini='{"section_name":"'.$ipp['nama_section'].'","back_office":"'.$ipp['backoffice'].'","keterangan":"'.$ipp['keterangan'].'","judul_app":"'.$ipp['judul_app'].'","sub_judul":"'.$ipp['sub_judul'].'","alertafter":"'.$ipp['alertafter'].'","logoutafter":"'.$ipp['logoutafter'].'"}';
		$sqlstr="INSERT INTO cmf_setting (id_item,nama_item,id_setting,meta_value) VALUES ('$maxid','".$ipp['nama_grup']."','13','$ini')";		
		$this->db->query($sqlstr);
	}
    function edit_grup_aksi($idg,$ipp){
		$ini='{"section_name":"'.$ipp['nama_section'].'","back_office":"'.$ipp['backoffice'].'","keterangan":"'.$ipp['keterangan'].'","judul_app":"'.$ipp['judul_app'].'","sub_judul":"'.$ipp['sub_judul'].'","alertafter":"'.$ipp['alertafter'].'","logoutafter":"'.$ipp['logoutafter'].'"}';

		$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_grup']."',meta_value='$ini' WHERE id_item='$idg'";
		$this->db->query($sqlstr);
	}
    function hapus_grup_aksi($idg){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idg'";
		$this->db->query($sqlstr);

		$sqlstr2="DELETE FROM cmf_setting WHERE id_setting='3' AND meta_value LIKE '%\"group_id\":\"".$idg."\"%'";
		$this->db->query($sqlstr2);
	}
//////////////////////////////////////////////////////////////////////////////////
	function ganti_password($isi){
        $this->db->set('passwd',sha1($isi['pw1']));
        $this->db->where('user_id',$isi['user_id']);
		$this->db->update('users');
	}
}
