<?php
class M_direktori extends CI_Model{
	function __construct(){
		parent::__construct();
	}
//////////////////////////////////////////////////////////////////////////////////
	function detail_kategori($idd){
		$hslquery = $this->db->get_where('cmf_setting', array('id_item' => $idd));
		return $hslquery->result();
	}
	function getlabel($kategori){
		$sqlstr="SELECT *
		FROM konten_appe 
		WHERE tipe='atribut_direktori' AND id_konten='$kategori'
		ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		return $hslquery;
	}
    function hapus_kategori_aksi($idp,$idk){
		$sqlstr="DELETE FROM cmf_setting WHERE id_item='$idp'";
		$this->db->query($sqlstr);

		$sqlstr="DELETE FROM konten_appe WHERE id_konten='$idp' AND tipe='atribut_direktori'";
		$this->db->query($sqlstr);

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
    function tambah_kategori_aksi($ipp){
			$sqlstr="SELECT MAX(id_item) as maxid FROM cmf_setting WHERE id_setting='9'";
			$hslquery=$this->db->query($sqlstr)->row();
			$maxid = $hslquery->maxid+1;

			$query=$this->db->query("SELECT MAX(urutan) as count_nik FROM cmf_setting WHERE id_setting='9' AND meta_value LIKE '%\"id_kanal\":\"".$ipp['idd_kanal']."\"%'"); 
			$row = $query->row_array();		$max2 = $row['count_nik']+1;
			$ini="{\"id_kanal\":\"".$ipp['idd_kanal']."\",\"komponen\":\"".$ipp['komponen']."\",\"keterangan\":\"".$ipp['keterangan']."\",\"paging_index\":\"".$ipp['paging_index']."\",\"paging_arsip\":\"".$ipp['paging_arsip']."\",\"status\":\"publish\"}";

			$this->db->set('id_item',$maxid);
			$this->db->set('id_setting','9');
			$this->db->set('nama_item',$ipp['nama_kategori']);
			$this->db->set('urutan',$max2);
			$this->db->set('meta_value',$ini);
			$this->db->insert('cmf_setting');
			$id_label = $this->db->insert_id();

			$this->db->set('tipe','atribut_direktori');
			$this->db->set('judul_appe',$ipp['label'][0]);
			$this->db->set('urutan_appe','1');
			$this->db->set('id_konten',$id_label);
			$this->db->insert('konten_appe');
	}

    function tambah_atribut_aksi($isi){
		$this->db->set('tipe','atribut_direktori');
		$this->db->set('judul_appe',$isi['label']);
		$this->db->set('id_konten',$isi['idd']);
		$this->db->set('urutan_appe',$isi['urutan']);
		$this->db->insert('konten_appe');
		$id_label = $this->db->insert_id();

		$sqlstr="SELECT * FROM konten  WHERE komponen='direktori' AND id_kategori='".$isi['idd']."'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$rpc=array("]","[");
			$ty=str_replace($rpc,"",$val->isi_konten);
			$ty="[".$ty.",{\"label\":\"".$id_label."\",\"nilai\":\"\"}]";
				$this->db->set('isi_konten',$ty);
				$this->db->where('id_konten',$val->id_konten);
				$this->db->update('konten');
		}
	}

    function hapus_atribut_aksi($isi){
		$sqlstr="SELECT * FROM konten  WHERE komponen='direktori' AND id_kategori='".$isi['id_kat']."'";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$gu = json_decode($val->isi_konten);
			$gy="[";
			foreach($gu AS $ky=>$vl){
				$ft = ($vl->label!=$isi['id_atr'])?'{"label":"'.$vl->label.'","nilai":"'.$vl->nilai.'"}':'';
				$pr = ($ky==0)?"":",";
				if($ft!=''){$gy = $gy.$pr.$ft;}
			}
			$gy=$gy."]";
		$this->db->set('isi_konten',$gy);
		$this->db->where('id_konten',$val->id_konten);
		$this->db->update('konten');
		}

		$this->db->where('id_appe',$isi['id_atr']);
		$this->db->delete('konten_appe');

		$sqlstr="SELECT * FROM konten_appe  WHERE tipe='atribut_direktori' AND id_konten='".$isi['id_kat']."' ORDER BY urutan_appe ASC";
		$hslquery=$this->db->query($sqlstr)->result();
		foreach($hslquery AS $key=>$val){
			$this->db->set('urutan_appe',($key+1));
			$this->db->where('id_appe',$val->id_item);
			$this->db->update('konten_appe');
		}
	}

    function reurut_atribut_aksi($isi){
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_lawan']."' WHERE id_appe='".$isi['id_ini']."'";
		$this->db->query($sqlstr);
		$sqlstr="UPDATE konten_appe SET urutan_appe='".$isi['urutan_ini']."' WHERE id_appe='".$isi['id_lawan']."'";
		$this->db->query($sqlstr);
	}

    function edit_kategori_aksi($ipp){
		for($i=0;$i<count($ipp['label']);$i++){
			$sqlstr="UPDATE konten_appe SET judul_appe='".$ipp['label'][$i]."' WHERE id_appe='".$ipp['id_label'][$i]."'";
//			$this->db->query($sqlstr);
		}

			$ini="{\"id_kanal\":\"".$ipp['idd_kanal']."\",\"komponen\":\"".$ipp['komponen']."\",\"keterangan\":\"".$ipp['keterangan']."\",\"paging_index\":\"".$ipp['paging_index']."\",\"paging_arsip\":\"".$ipp['paging_arsip']."\",\"status\":\"publish\"}";
			$sqlstr="UPDATE cmf_setting SET nama_item='".$ipp['nama_kategori']."', meta_value='$ini'
			WHERE id_item='".$ipp['idd']."'";		
			$this->db->query($sqlstr);
	}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
	function hitung_direktori($path){
		$query=$this->db->query("SELECT count(id_konten) as count_nik FROM konten WHERE komponen='direktori' AND id_kategori='$path'"); 
		$row = $query->row_array();
		$hslrow['count'] = $row['count_nik'];
		return $hslrow;
	}
	function getdirektori($mulai,$batas,$path){
		$sqlstr="SELECT * FROM konten  WHERE komponen='direktori' AND id_kategori='$path' ORDER BY urutan ASC  LIMIT $mulai,$batas";
		$hslquery=$this->db->query($sqlstr);
		return $hslquery;
	}
    function tambah_direktori_aksi($isi){
			$this->db->select_max('urutan','count_nik');
			$this->db->where('id_kategori',$isi['id_kategori']);
			$row = $this->db->get('konten')->result();
			$max = $row[0]->count_nik+1;

		$ini="[";
		foreach($isi['isi_atribut'] AS $key=>$val){
			$ini.=($key==0)?"{\"label\":\"".$isi['label'][$key]."\",\"nilai\":\"".$val."\"}":", {\"label\":\"".$isi['label'][$key]."\",\"nilai\":\"".$val."\"}";
		}
		$ini.="]";

		$sqlstr="INSERT INTO konten (judul,id_kategori,komponen,isi_konten,urutan) 
		VALUES ('".$isi['nama_direktori']."','".$isi['id_kategori']."','direktori','$ini','$max')";		
		$this->db->query($sqlstr);

	}
	function inidirektori($idd){
		$hslquery = $this->db->get_where('konten', array('id_konten' => $idd));
		return $hslquery->result();
	}

    function edit_direktori_aksi($isi){
		$ini="[";
		foreach($isi['isi_atribut'] AS $key=>$val){
			$ini.=($key==0)?"{\"label\":\"".$isi['label'][$key]."\",\"nilai\":\"".$val."\"}":", {\"label\":\"".$isi['label'][$key]."\",\"nilai\":\"".$val."\"}";
		}
		$ini.="]";
		$sqlstr="UPDATE konten SET judul='".$isi['nama_direktori']."', isi_konten='$ini' WHERE id_konten='".$isi['id_konten']."'";
		$this->db->query($sqlstr);
	}
    function hapus_direktori_aksi($isi){
		$sqlstr="DELETE FROM konten WHERE id_kategori='".$isi['id_kategori']."' AND id_konten='".$isi['id_konten']."'";
		$this->db->query($sqlstr);
	}


}
