<?php
class M_kanal extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function getkanal($idparent){
		$this->db->select('id_item AS id_kanal, nama_item AS nama_kanal, id_parent,urutan,meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','8');
		$this->db->where('id_parent',$idparent);
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get()->result();
		return $query;
	}
	function inikanal($idd){
		$this->db->from('cmf_setting');
//		$this->db->where('id_setting','1');
		$this->db->where('id_item',$idd);
		$hslquery = $this->db->get()->row();
		
					@$hsl = json_decode($hslquery->meta_value);
					@$hslq->nama_kanal=$hslquery->nama_item;
					$hslq->path_kanal=@$hsl->path_kanal;
					$hslq->tipe=@$hsl->tipe;
					$hslq->theme=@$hsl->theme;
					$hslq->keterangan=@$hsl->keterangan;
					$hslq->id_kanal=@$hslquery->id_item;
					return $hslq;
	}
    function cek_kanal_rubrik($id_kanal){
/*
		$this->db->select('nama_item');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','6');
		$this->db->like('meta_value','\"id_kanal\":\"'.$id_kanal.'\"');
		$query = $this->db->get()->result();
		return $query;
*/
		$sqlstr1="SELECT nama_item FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"id_kanal\":\"".$id_kanal."\"%'";
		$hslquery1=$this->db->query($sqlstr1)->result();
		return $hslquery1;
	}
    function cek_kanal_wrapper($id_kanal){
/*
		$this->db->select('meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','10');
		$this->db->like('meta_value','\"id_kanal\":\"'.$id_kanal.'\"');
		$query = $this->db->get()->result();
		return $query;
*/
		$sqlstr1="SELECT meta_value FROM cmf_setting WHERE id_setting='11' AND meta_value LIKE '%\"id_kanal\":\"".$id_kanal."\"%'";
		$hslquery1=$this->db->query($sqlstr1)->result();
		return $hslquery1;
	}
    function hapus_item_aksi($idp){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idp'";
		$this->db->query($sqlstr);
	}
    function tambah_aksi($ipp){
			$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM cmf_setting WHERE id_setting='8' AND id_parent='".$ipp['idparent']."'"); 
			$row = $query->row_array();		$max = $row['count_nik']+1;

			$sqlstrA="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting IN (7,8)";
			$hslqueryA=$this->db->query($sqlstrA)->row();
			$maxidA = $hslqueryA->maxid+1;

		if($ipp['level']==0){
			$ini="{\"path_kanal\":\"".$ipp['kanal_path']."\",\"path_root\":\"".$ipp['kanal_path']."\",\"status\":\"on\",\"keterangan\":\"".$ipp['keterangan']."\",\"tipe\":\"".$ipp['tipe']."\",\"theme\":\"".$ipp['theme']."\"}";
			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,id_parent,nama_item,urutan,meta_value) 
			VALUES ('$maxidA','8','".$ipp['idparent']."','".$ipp['nama_kanal']."','$max','$ini')";
			$this->db->query($sqlstr);
		} else {
			$sqlstr1="SELECT meta_value FROM cmf_setting WHERE id_item=".$ipp['idparent']."";
			$hslquery1=$this->db->query($sqlstr1)->row();
			$jj = json_decode($hslquery1->meta_value);
			$pth = $jj->path_kanal;

			$ini="{\"path_kanal\":\"".$ipp['kanal_path']."\",\"path_root\":\"".$pth."\",\"status\":\"on\",\"keterangan\":\"".$ipp['keterangan']."\",\"tipe\":\"".$ipp['tipe']."\",\"theme\":\"".$ipp['theme']."\"}";
			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,id_parent,nama_item,urutan,meta_value) 
			VALUES ('$maxidA','8','".$ipp['idparent']."','".$ipp['nama_kanal']."','$max','$ini')";
			$this->db->query($sqlstr);
		}
			//***khusus insert header kanal***//
			$idd = $this->db->insert_id();
			$nama = $this->getopsivalue('nama_app');
			$slogan = $this->getopsivalue('slogan_app');
			$ini='{"id_kanal":"'.$idd.'","judul_header":"'.$nama.'","sub_judul":"'.$slogan.'","tinggi_header":"80px","margin_top":"10px","margin_bottom":"10px","padding_top":"10px","padding_bottom":"10px"}';

			$sqlstrB="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='10'";
			$hslqueryB=$this->db->query($sqlstrB)->row();
			$maxidB = $hslqueryB->maxid+1;

			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,meta_value) VALUES ('$maxidB','10','$ini')";
			$this->db->query($sqlstr);

	}
    function edit_aksi($ipp){
		if($ipp['level']==0){
			$path_root=$ipp['kanal_path'];
			$ini="{\"path_kanal\":\"".$ipp['kanal_path']."\",\"path_root\":\"".$path_root."\",\"status\":\"on\",\"keterangan\":\"".$ipp['keterangan']."\",\"tipe\":\"".$ipp['tipe']."\",\"theme\":\"".$ipp['theme']."\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_kanal']."',meta_value='$ini' WHERE id_item='".$ipp['idk']."'";
			$this->db->query($sqlstr);

			$sqlstr1="SELECT id_item,meta_value FROM cmf_setting WHERE id_parent=".$ipp['idk']."";
			$hslquery1=$this->db->query($sqlstr1)->result();
			foreach($hslquery1 AS $key=>$val){
				$jj = json_decode($val->meta_value);
				$ini="{\"path_kanal\":\"".$jj->path_kanal."\",\"path_root\":\"".$path_root."\",\"status\":\"on\",\"keterangan\":\"".$jj->keterangan."\",\"tipe\":\"".$jj->tipe."\",\"theme\":\"".$jj->theme."\"}";
				$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$val->id_item."'";
				$this->db->query($sqlstr);
			}
		} else {
			$ini="{\"path_kanal\":\"".$ipp['kanal_path']."\",\"path_root\":\"".$ipp['path_lama']."\",\"status\":\"on\",\"keterangan\":\"".$ipp['keterangan']."\",\"tipe\":\"".$ipp['tipe']."\",\"theme\":\"".$ipp['theme']."\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_kanal']."',meta_value='$ini' WHERE id_item='".$ipp['idk']."'";
			$this->db->query($sqlstr);
		}

		$sqlstr1="SELECT id_item,meta_value FROM cmf_setting WHERE id_setting='11' AND meta_value LIKE '%\"id_kanal\":\"".$ipp['idk']."\"%'";
		$hslquery1=$this->db->query($sqlstr1)->result();
		foreach($hslquery1 AS $key=>$val){
			$jlama = '"path_kanal":"'.$ipp['kanal_lama'].'"';
			$jbaru = '"path_kanal":"'.$ipp['kanal_path'].'"';
			$baru = str_replace($jlama, $jbaru,$val->meta_value);
			$sqlstr="UPDATE cmf_setting SET meta_value='$baru' WHERE id_item='".$val->id_item."'";
			$this->db->query($sqlstr);
		}

	}
    function hapus_kanal_aksi($ipp){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='".$ipp['idk']."'";
		$this->db->query($sqlstr);
			$sqlstr1="SELECT id_item,urutan FROM cmf_setting WHERE id_setting='8' AND id_parent=".$ipp['id_parent']." ORDER BY urutan";
			$hslquery1=$this->db->query($sqlstr1)->result();
			foreach($hslquery1 AS $key=>$val){
				$sqlstr="UPDATE cmf_setting SET urutan='".($key+1)."' WHERE id_item='".$val->id_item."'";
				$this->db->query($sqlstr);
			}

		$this->db->where('id_setting','10');
		$this->db->like('meta_value','\"id_kanal\":\"'.$ipp['idk'].'\"');
		$this->db->delete('cmf_setting');
	}


//////////////////////////////////////////////////////////////////////////////////
	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->result();
		$ff=json_decode(@$hslqueryp[0]->meta_value);
		return $ff->nilai;
	}

	function get_header_kanal($idd){
		$this->db->select('nama_item,meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','10');
		$this->db->like('meta_value','\"id_kanal\":\"'.$idd.'\"');
		$query = $this->db->get()->row();
		return $query;
	}

    function edit_header_aksi($ipp){
			$ini='{"id_kanal":"'.$ipp['idk'].'","judul_header":"'.$ipp['judul_header'].'","sub_judul":"'.$ipp['sub_judul'].'","tinggi_header":"'.$ipp['tinggi_header'].'","margin_top":"'.$ipp['margin_top'].'","margin_bottom":"'.$ipp['margin_bottom'].'","padding_top":"'.$ipp['padding_top'].'","padding_bottom":"'.$ipp['padding_bottom'].'"}';
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_setting='10' AND meta_value LIKE '%\"id_kanal\":\"".$ipp['idk']."\"%'";		
			$this->db->query($sqlstr);
	}

    function simpan_logo_kanal($id_kanal,$nama_file,$komponen){
			$sqlstr="UPDATE cmf_setting SET nama_item='$nama_file' WHERE id_setting='10' AND meta_value LIKE '%\"id_kanal\":\"".$id_kanal."\"%'";		
			$this->db->query($sqlstr);
	}
    function hapus_logo_aksi($id_kanal){
			$nm = $this->get_header_kanal($id_kanal);
			$sqlstr="UPDATE cmf_setting SET nama_item='' WHERE id_setting='10' AND meta_value LIKE '%\"id_kanal\":\"".$id_kanal."\"%'";		
			$this->db->query($sqlstr);
			return $nm->nama_item; 
	}

//////////////////////////////////////////////////////////////////////////////////
    function naik_index($id_ini,$id_lawan,$urutan_ini,$urutan_lawan){
		$sqlstr="UPDATE cmf_setting SET urutan='$urutan_lawan' WHERE id_item='$id_ini'";
		$this->db->query($sqlstr);
		$sqlstr="UPDATE cmf_setting SET urutan='$urutan_ini' WHERE id_item='$id_lawan'";
		$this->db->query($sqlstr);
	}	
//////////////////////////////////////////////////////////////////////////////////
	function inikanalkategori($idd){
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','9');
		$this->db->like('meta_value','\"id_kanal\":\"'.$idd.'\"');
		$this->db->order_by('urutan');
		$hslquery = $this->db->get()->result();
			foreach($hslquery AS $key=>$val){
				$jj = json_decode($val->meta_value);
				@$hslquery[$key]->id_kategori = $val->id_item;
				@$hslquery[$key]->komponen = $jj->komponen;
				@$hslquery[$key]->keterangan = $jj->keterangan;
			}
		
		return $hslquery;
	}
	function kontenkategori($idd) {
		$this->db->from('konten');
		$this->db->where('id_kategori',$idd);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function widgetkategori($idd,$komponen) {
		$this->db->from('konten_appe');
		$this->db->where('tipe','kategori_widget');
		$this->db->where('id_konten',$idd);
		$this->db->where('keterangan_appe',$komponen);
		$hslquery = $this->db->get()->result();
		return $hslquery;
	}
	function getwrapper_kanal($idk,$posisi){
		$this->db->select('id_item,meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','11');
		$this->db->where('nama_item',$posisi);
		$this->db->like('meta_value','\"id_kanal\":\"'.$idk.'\"');
		$hslquery = $this->db->get()->row();
		return $hslquery;
	}

	function getwrapper($path,$posisi){
		$this->db->select('meta_value');
		$this->db->from('cmf_setting');
		$this->db->where('id_setting','11');
		$this->db->where('nama_item',$posisi);
		$this->db->like('meta_value','\"path_kanal\":\"'.$path.'\"');
		$hslquery = $this->db->get()->row();

		$res=(!empty($hslquery->meta_value))	?	json_decode($hslquery->meta_value)	:	json_decode("{\"widget\":[]}");
		return $res;
	}

	function ini_wrapper($idd){
		$sqlstr="SELECT a.nama_item AS nama_wrapper FROM cmf_setting a WHERE a.id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		return $hslquery->nama_wrapper;
	}
	function urutan_wrapper_aksi($ipp){
		$sqlstr="SELECT id_item,meta_value FROM cmf_setting  WHERE id_setting='11' AND nama_item='".$ipp['posisi']."' AND meta_value LIKE '%\"id_kanal\":\"".$ipp['id_kanal']."\"%'";
		$data = $this->db->query($sqlstr)->row();
		$jj=json_decode($data->meta_value);
		
			$ini="{\"id_kanal\":\"".$jj->id_kanal."\",\"path_kanal\":\"".$jj->path_kanal."\",\"widget\":".$ipp['ini']."}";
			$sqlstr="UPDATE cmf_setting SET meta_value='$ini' WHERE id_item='".$data->id_item."'";		
			$this->db->query($sqlstr);
	}
	function input_wrapper_aksi($lok,$ipp){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='11'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = (isset($hslquery->maxid))?$hslquery->maxid+1:4000001;

			$this->db->set('id_item',$maxid);
			$this->db->set('nama_item',$lok);
			$this->db->set('id_setting',11);
			$this->db->set('meta_value',$ipp);
			$this->db->insert('cmf_setting');
	}
	function edit_wrapper_aksi($idd,$ipp){
			$this->db->set('meta_value',$ipp);
			$this->db->where('id_item',$idd);
			$this->db->update('cmf_setting');
	}
	function hapus_wrapper_aksi($idd,$ipp){
			$this->db->where('id_item',$idd);
			$this->db->delete('cmf_setting');
	}
	function kendali_kategori($ipp){
		if(isset($ipp['komponen'])){
				$this->db->where('tipe','kategori_widget');
				$this->db->where('keterangan_appe',$ipp['komponen']);
				$this->db->where('link',$ipp['id_widget']);
				$this->db->where('nilai',$ipp['idk']);
				$this->db->where('urutan_appe',$ipp['idd']);
				$this->db->delete('konten_appe');
		
				foreach($ipp['widget_isi'] AS $key=>$val){
					$this->db->set('id_konten',$val);
					$this->db->set('tipe','kategori_widget');
					$this->db->set('judul_appe',$ipp['lokasi']);
					$this->db->set('keterangan_appe',$ipp['komponen']);
					$this->db->set('nilai',$ipp['idk']);
					$this->db->set('link',$ipp['id_widget']);
					$this->db->set('urutan_appe',$ipp['idd']);
					$this->db->insert('konten_appe');
				}
		}
	}
	function kendali_kategori_hapus($ipp){
		$this->db->where('tipe','kategori_widget');
		$this->db->where('link',$ipp['id_widget']);
		$this->db->where('nilai',$ipp['idk']);
		$this->db->where('urutan_appe',$ipp['idd']);
		$this->db->delete('konten_appe');
	}
//////////////////////////////////////////////////////////////////////////////////
	function getwidget_posisi($posisi){
		$sqlstr="SELECT a.*	FROM cmf_setting a WHERE a.id_setting='5' AND meta_value LIKE '%\"lokasi_widget\":\"".$posisi."\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function hitung_widget(){
		$query=$this->db->query("SELECT count(id_item) as count_nik FROM cmf_setting WHERE id_setting='5'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getwidgetkanal_urutan($posisi,$id_kanal,$urutan){
		$sqlstr="SELECT meta_value	FROM cmf_setting a WHERE a.id_setting='11' AND  a.nama_item='$posisi' AND meta_value LIKE '%\"id_kanal\":\"".$id_kanal."\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
		$jj = json_decode($hslquery->meta_value);
		$widget = $jj->widget;
		
		return $widget[$urutan];
	}
//////////////////////////////////////////////////////////////////////////////////
	function ini_item($nid){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_item='".$nid."'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
	function getkategori_by_komponen($komponen){
		$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='6' AND meta_value LIKE '%\"komponen\":\"$komponen\"%'";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function tambah_kategori_aksi($ipp){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='9'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = (isset($hslquery->maxid))?($hslquery->maxid+1):2000001;

			$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"id_kanal\":\"".$ipp['idd_kanal']."\"%'"); 
			$row = $query->row_array();		$max2 = $row['count_nik']+1;
			$ini="{\"id_kanal\":\"".$ipp['idd_kanal']."\",\"komponen\":\"".$ipp['komponen']."\",\"keterangan\":\"".$ipp['keterangan']."\",\"paging_index\":\"".$ipp['paging_index']."\",\"paging_arsip\":\"".$ipp['paging_arsip']."\",\"status\":\"publish\"}";

			$sqlstr="INSERT INTO cmf_setting (id_item,id_setting,nama_item,urutan,meta_value) VALUES ('$maxid','9','".$ipp['nama_kategori']."','$max2','$ini')";		
			$this->db->query($sqlstr);
	}
    function edit_kategori_aksi($ipp){
			$ini="{\"id_kanal\":\"".$ipp['idd_kanal']."\",\"komponen\":\"".$ipp['komponen']."\",\"keterangan\":\"".$ipp['keterangan']."\",\"paging_index\":\"".$ipp['paging_index']."\",\"paging_arsip\":\"".$ipp['paging_arsip']."\",\"status\":\"publish\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_kategori']."', meta_value='$ini'
			WHERE id_item='".$ipp['idd']."'";		
			$this->db->query($sqlstr);
	}
    function hapus_kategori_aksi($idp,$idk){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idp'";
		$this->db->query($sqlstr);

		$sqlstr="DELETE FROM cmf_setting WHERE id_parent='$idp'";
		$this->db->query($sqlstr);

		$this->re_urut_kategori($idk);
	}
    function pindah_kategori_aksi($id_item,$k_lama,$k_baru){
			$lama = $this->ini_item($id_item);
			$jlama = '"id_kanal":"'.$k_lama.'"';
			$jbaru = '"id_kanal":"'.$k_baru.'"';
			$baru = str_replace($jlama, $jbaru,$lama[0]->meta_value);
			$sqlstr="UPDATE cmf_setting SET meta_value='$baru' WHERE id_item='$id_item'";
			$this->db->query($sqlstr);
			$this->re_urut_kategori($k_lama);
			$this->re_urut_kategori($k_baru);
	}
    function re_urut_kategori($idk){
			$sqlstr="SELECT * FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"id_kanal\":\"".$idk."\"%' ORDER BY urutan ASC"; 
			$hslquery = $this->db->query($sqlstr)->result();
				$urutan=1;
				foreach($hslquery AS $key=>$val){
					$this->db->set('urutan',$urutan);
					$this->db->where('id_item',$val->id_item);
					$this->db->update('cmf_setting');
					$urutan++;
				}
	}


}
