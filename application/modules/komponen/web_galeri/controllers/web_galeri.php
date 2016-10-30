<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_galeri extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_web_galeri');
		$this->load->model('web_artikel/m_artikel_baca');
	}

	public function read($kat,$id_konten)	{
		$data['konten']=$this->m_web_galeri->ini_galeri($id_konten);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$judulseo=str_replace($d, '-', $data['konten']->judul);

		if(!$data['konten']->id_konten || str_replace(" ","-",$data['konten']->nama_kategori)!=$kat || $this->uri->segment(5)!=$judulseo ){
				redirect(site_url());
		} else {
			Modules::run("web/counter",$id_konten);
			$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
			$data['konten']->hari=$hh[@$data['konten']->hari_buat];

			$data['isi']=$this->m_web_galeri->album_galeri($id_konten);

			$data['jkanal'] = Modules::run("web/root_kanal",$data['konten']->id_kanal);
			$data['kanal']	= Modules::run("web/cari_kanal",$data['konten']->id_kanal);
			$sess['kanal'] = $data['kanal']->kanal_path;
			$sess['tipe_kanal'] = $data['kanal']->tipe;
			$sess['id_kanal'] = $data['kanal']->id_kanal;
			$sess['theme'] = $data['kanal']->theme;
			$sess['id_konten'] = $id_konten;
			$sess['id_kategori'] = $data['konten']->id_kategori;
			$sess['nama_kategori'] = $data['konten']->nama_kategori;
			$this->session->set_userdata('visit', $sess);

			$data['cLampiran'] = Modules::run("element/lampiran/index",$id_konten);
			$data['cKomentar'] = Modules::run("element/komentar/index",$id_konten);
				$path='assets/themes/'.$sess['theme'].'/komponen/web_galeri/read.php';
				if(file_exists($path)){	
					$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_galeri/';
					$this->load->view($this->viewPath.'read',$data);
				} else {
					$this->load->view('read',$data);
				}
		}
	}

	public function read_side()	{
		$sess = $this->session->userdata('visit');
		$data['arsip'] = Modules::run("web_galeri/daftar_arsip");
		$data['daftar_kategori'] = Modules::run("web_galeri/all_side");

			$path='assets/themes/'.$sess['theme'].'/komponen/web_galeri/read_side.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_galeri/';
				$this->load->view($this->viewPath.'read_side',$data);
			} else {
				$this->load->view('read_side',$data);
			}
	}

	public function daftar_arsip()	{
		$sess = $this->session->userdata('visit');
		$data['id_konten'] = $sess['id_konten'];
		$data['id_kategori'] = $sess['id_kategori'];
		$data['nama_kategori'] = $sess['nama_kategori'];

		$rubrik = $this->m_artikel_baca->nama_rubrik($data['id_kategori']);
		$jjR = json_decode($rubrik->meta_value);
		$data['batas'] = (isset($jjR->paging_arsip))?$jjR->paging_arsip:2;
		$urutan=$this->m_web_galeri->urutan_galeri($sess['id_konten'],$sess['id_kategori']);
		$data['hal']=ceil($urutan['count']/$data['batas']);

			$path='assets/themes/'.$sess['theme'].'/komponen/web_galeri/arsip.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_galeri/';
				$this->load->view($this->viewPath.'arsip',$data);
			} else {
				$this->load->view('arsip',$data);
			}
	}

	public function getgaleri()	{
		$batas=$_POST['batas'];
		$rubrik=$_POST['rubrik'];
		$dt=$this->m_web_galeri->hitung_album($rubrik); 

		if($_POST['hal']=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$_POST['hal'];	}
		$mulai=($hal-1)*$batas;
		$data['mulai']=$mulai+1;

		$data['hslquery']=$this->m_web_galeri->getalbum($mulai,$batas,$rubrik)->result();
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";
		foreach($data['hslquery'] as $key=>$val){
			$data['hslquery'][$key]->seo=str_replace($d, '-', $val->judul);
			$data['hslquery'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
			$data['hslquery'][$key]->hari_buat=$hh[$val->hari_buat];
		}

		$data['pager']=Modules::run("web/pagerA",$dt['count'],$batas,$hal,2);
		echo json_encode($data);
	}

	public function all($t_hal,$t_id_kat)	{
		$sess = Modules::run("web/ikanal",$t_id_kat);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$judulseo=str_replace($d, '-', $sess->nama_item);
		$er = $this->form_validation->is_natural_no_zero($this->uri->segment(4));
		if(!$sess->id_kanal || $judulseo!=$this->uri->segment(5) || $er==FALSE){
				redirect(site_url());
		} else {

				$data['id_kanal'] = @$sess->id_kanal;
				$data['jkanal']=Modules::run('web/root_kanal',$sess->id_kanal);
				$dkn = Modules::run("web/cari_kanal",$sess->id_kanal);
				$sessm['kanal'] = $dkn->kanal_path;
				$sessm['tipe_kanal'] = $dkn->tipe;
				$sessm['id_kanal'] = $sess->id_kanal;
				$sessm['theme'] = $dkn->theme;
				$sessm['id_kategori'] = $t_id_kat;
				$this->session->set_userdata('visit', $sessm);

				$rubrik = $this->m_artikel_baca->nama_rubrik($t_id_kat);
				$jjR = json_decode($rubrik->meta_value);
				$data['rubrik'] = $rubrik->nama_item;
				$data['kat_seo'] = $this->uri->segment(5);

				$dt=$this->m_web_galeri->hitung_album($t_id_kat); 
				$batas=(isset($jjR->paging_index))?$jjR->paging_index:2;
				$data['id_rubrik']=$t_id_kat;
				if($t_hal=="end"){	$hal=ceil($dt['count']/$batas);		} else {	$hal=$t_hal;	}
				$mulai=($hal-1)*$batas;
				$data['mulai']=$mulai+1;
				$data['isi']=$this->m_web_galeri->getalbum($mulai,$batas,$t_id_kat)->result();
				$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";

				foreach($data['isi'] as $key=>$val){
					@$data['isi'][$key]->seo=str_replace($d, '-', $val->judul);
					$data['isi'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
					$data['isi'][$key]->hari=$hh[$val->hari_buat];
					$fr=$val->isi_konten;
					$df=explode("\n",$fr);
					$data['isi'][$key]->sub=$df[0];
					$data['isi'][$key]->thumb = (!empty($val->foto))?$val->id_konten."/thumbs_".$val->foto:"default/no_image.gif" ;
				}

				$pph=site_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
				$ddmm = Modules::run("web/pagerB",$dt['count'],$batas,$hal,5);
				$ganti=str_replace("XX",$pph,$ddmm);
				$ganti=str_replace("YY",$this->uri->segment(5),$ganti);
				$data['pager']=(empty($data['isi']))?"...":$ganti;
	
						$path='assets/themes/'.$sessm['theme'].'/komponen/web_galeri/all.php';
						if(file_exists($path)){	
							$this->viewPath = '../../assets/themes/'.$sessm['theme'].'/komponen/web_galeri/';
							$this->load->view($this->viewPath.'all',$data);
						} else {
							$this->load->view('all',$data);
						}
		}
	}

	public function all_side()	{
		$sess = $this->session->userdata('visit');
		$data['kategori'] = Modules::run("element/daftar_kategori/index",$sess['id_kanal'],"galeri",$sess['id_kategori']);

			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/web_galeri/daftar_kategori.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_galeri/';
				$this->load->view($this->viewPath.'daftar_kategori',$data);
			} else {
				$this->load->view('daftar_kategori',$data);
			}
	}

}