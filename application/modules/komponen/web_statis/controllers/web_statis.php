<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_statis extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_statis');
	}


	public function read($kat,$id_konten)	{
////khusus untuk menampilkan "hasil pencarian"
		$data['konten'] = $this->m_statis->inistatis($id_konten);
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$judulseo=str_replace($d, '-', $data['konten']->judul);

		if(!$data['konten']->id_konten || str_replace(" ","-",$data['konten']->nama_kategori)!=$kat || $this->uri->segment(5)!=$judulseo ){
				redirect(site_url());
		} else {
			Modules::run("web/counter",$id_konten);
			$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";

			$data['jkanal']= Modules::run('web/root_kanal',$data['konten']->id_kanal);
			$data['kanal'] = Modules::run('web/cari_kanal',$data['konten']->id_kanal);
				$sess['kanal'] = $data['kanal']->kanal_path;
				$sess['tipe_kanal'] = $data['kanal']->tipe;
				$sess['id_kanal'] = $data['konten']->id_kanal;
				$sess['theme'] = $data['kanal']->theme;

				$sess['id_konten'] = $id_konten;
				$sess['id_kategori'] = $data['konten']->id_kategori;
				$sess['nama_kategori'] = $data['konten']->nama_kategori;
				$this->session->set_userdata('visit', $sess);

				$sess['id_konten'] = $id_konten;
				$sess['id_kategori'] = $data['konten']->id_kategori;
				$sess['nama_kategori'] = $data['konten']->nama_kategori;
				$this->session->set_userdata('visit', $sess);
			$data['cGambar'] = Modules::run("element/gambar/index",$id_konten);
			$data['cLampiran'] = Modules::run("element/lampiran/index",$id_konten);
			$data['cKomentar'] = Modules::run("element/komentar/index",$id_konten);
				$path='assets/themes/'.$sess['theme'].'/komponen/web_statis/read.php';
				if(file_exists($path)){	
					$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_statis/';
					$this->load->view($this->viewPath.'read',$data);
				} else {
					$this->load->view('read',$data);
				}
		}
	}

	public function read_side()	{
		$sess = $this->session->userdata('visit');
		$data['kategori'] = Modules::run("element/daftar_kategori/index",$sess['id_kanal'],"statis",$sess['id_kategori']);

			$sess = $this->session->userdata('visit');
			$path='assets/themes/'.$sess['theme'].'/komponen/web_statis/daftar_kategori.php';
			if(file_exists($path)){	
				$this->viewPath = '../../assets/themes/'.$sess['theme'].'/komponen/web_statis/';
				$this->load->view($this->viewPath.'daftar_kategori',$data);
			} else {
				$this->load->view('daftar_kategori',$data);
			}
	}


}