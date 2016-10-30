<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formadmin extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('m_artikel_slider');
		$this->auth->restrict();
	}

	public function tambah()	{
			$tpl_1= Modules::run("cmshome/margin_options","10px");
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options","10px");
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$tpl_3= Modules::run("cmshome/banyak_post_options",5);
			$data['banyak_post']="<select id='nilai[2]' name='nilai[2]'  class='form-control'>".$tpl_3."</select>";
			$tpl_4= Modules::run("cmshome/durasi_options","1000");
			$data['durasi']="<select id='nilai[3]' name='nilai[3]'  class='form-control'>".$tpl_4."</select>";

			$rbk = $this->m_artikel_slider->getkategori_by_komponen("artikel");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td>";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."'>";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}

	public function edit()	{
			$id_kategori = ($_POST['id_kategori']=="{}")?array():explode(",",$_POST['id_kategori']);
			$data['nilai'] = explode(",",$_POST['opsi']);

			$tpl_1= Modules::run("cmshome/margin_options",$data['nilai'][0]);
			$data['margin_atas']="<select id='nilai[0]' name='nilai[0]'  class='form-control'>".$tpl_1."</select>";
			$tpl_2= Modules::run("cmshome/margin_options",$data['nilai'][1]);
			$data['margin_bawah']="<select id='nilai[1]' name='nilai[1]'  class='form-control'>".$tpl_2."</select>";
			$tpl_3= Modules::run("cmshome/banyak_post_options",$data['nilai'][2]);
			$data['banyak_post']="<select id='nilai[2]' name='nilai[2]'  class='form-control'>".$tpl_3."</select>";
			$tpl_4= Modules::run("cmshome/durasi_options",@$data['nilai'][3]);
			$data['durasi']="<select id='nilai[3]' name='nilai[3]'  class='form-control'>".$tpl_4."</select>";

			$rbk = $this->m_artikel_slider->getkategori_by_komponen("artikel");
			$data['pilisi']="";
			foreach($rbk as $key=>$val){
				$chk = (in_array($val->id_item,$id_kategori))?"checked":"";
				$jb=json_decode($val->meta_value);
				$data['pilisi'].="<tr>";
				$data['pilisi'].="<td>".($key+1)."</td><td>";
				$data['pilisi'].="<input type=checkbox name=widget_isi[] id=widget_isi value='".$val->id_item."' ".$chk.">";
				$data['pilisi'].="</td><td>".$val->nama_item."</td><td>".$jb->keterangan."</td></tr>";
			}

		$this->load->view('formadmin',$data);
	}


///////////////////////////////////////////////////////////////////////////////////
//   FUNGSI-FUNGSI TAMBAHAN, KHUSUS UNTUK WIDGET YANG MEMBUTUHKAN SLIDER
///////////////////////////////////////////////////////////////////////////////////
	public function formfitur($id_widget,$id_kategories,$opsi){
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		$data['daftar'] = $this->m_artikel_slider->getwidget($id_widget,$id_kategories,$opsi[2]->nilai);
		foreach($data['daftar'] as $it=>$val){
			@$data['daftar'][$it]->hari = $hh[$val->hari];

			$cek2 = $this->m_artikel_slider->sliderkonten($val->id_konten);
			if(!empty($cek2)){
				$data['daftar'][$it]->cek2="ada";
				$data['daftar'][$it]->slider="<img src='".base_url().@$cek2[0]->foto."' height=40 border=0>";
			} else {
				$data['daftar'][$it]->cek2="kosong";
				$data['daftar'][$it]->slider="<img src='".base_url()."assets/media/no_slider.gif' height=40 border=0>";
			}
		}
		
		$this->load->view('formfitur',$data);
	}

	public function form_upload(){
		$data['idd'] = $_POST['idd'];
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		$data['konten'] = Modules::run("cmshome/detailkonten",$_POST['idd']);
		$data['konten']->hari = $hh[$data['konten']->hari];

		$cek2 = $this->m_artikel_slider->sliderkonten($_POST['idd']);
		if(!empty($cek2)){
			$data['dcek'] = "ada";
			$data['gambar'] = "<img src='".base_url().$cek2[0]->foto."' height=80 border=0>";
		} else {
			$data['dcek'] = "kosong";
			$data['gambar'] = "<img src='".base_url()."assets/media/no_slider.gif' height=80 border=0>";
		}

		$this->load->view('form_upload',$data);
	}
///////////////////////////////////////////////////////////////////
/////////////////////////////SLIDER HANDLING //////////////////////
	function saveslider(){
		$sql = "SELECT * FROM konten_appe WHERE id_appe='".$_POST['idd']."'";
		$qry = $this->db->query($sql)->row();
		if($qry->keterangan_appe=="jpg" || $qry->keterangan_appe=="gif" || $qry->keterangan_appe=="png" || $qry->keterangan_appe=="JPG" || $qry->keterangan_appe=="GIF" || $qry->keterangan_appe=="PNG"){
			$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$_POST['id_konten']."' AND tipe='artikel_slider'";//// Untuk mencatat jumlah pemakaian file ini
			$this->db->query($sqlstr);
			$sqA = "INSERT INTO konten_appe (id_konten,tipe,foto,foto_from) VALUES ('".$_POST['id_konten']."','artikel_slider','".$_POST['path']."','".$_POST['idd']."')";
			$qrA = $this->db->query($sqA);
			$sqlstr="UPDATE konten_appe SET nilai='".($qry->nilai+1)."' WHERE id_appe='".$_POST['idd']."'";//// Untuk mencatat jumlah pemakaian file ini
			$this->db->query($sqlstr);
		}
		echo "sukses";
	}
	function hapusslider(){
		$sq = "SELECT * FROM konten_appe WHERE id_konten='".$_POST['id_konten']."' AND tipe='artikel_slider'";
		$qr = $this->db->query($sq)->row();

		$sqlstr="DELETE FROM konten_appe WHERE id_konten='".$_POST['id_konten']."' AND tipe='artikel_slider'";//// Untuk mencatat jumlah pemakaian file ini
		$this->db->query($sqlstr);

		$sqB = "UPDATE konten_appe SET nilai=(nilai-1) WHERE id_appe='".$qr->foto_from."'";
		$qrB = $this->db->query($sqB);
		echo "sukses";
	}
}