<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget_pencarian extends MX_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('m_pencarian');
	}

	public function index()	{
		$sess = $this->session->userdata('visit');
		$data['kata_kunci'] = $sess['kata_kunci'];
		$data['hal']=1;
		$data['batas']=10;

		$this->load->view('index',$data);
	}

	public function gethasil()	{
		$er = $this->form_validation->is_natural_no_zero($_POST['hal']);
		$es = $this->form_validation->xss_clean($_POST['hal']);
		if($er==FALSE || $es==FALSE){	
			$data['hslquery']= "xx_xx";	
		} else {
				$kkunci = $_POST['kkunci'];

				$dt = $this->m_pencarian->hitungpencarian($kkunci);
		
				if($dt['count']==0){
					$data['hslquery']="";
					$data['pager'] = "<input type=hidden id='inputpaging' value='1'>";
				} else {
					$batas=$_POST['batas'];
					$hal = ($_POST['hal']=="end")?ceil($dt['count']/$batas):$_POST['hal'];
					$mulai=($hal-1)*$batas;
					$data['mulai']=$mulai+1;
					$data['hslquery'] = $this->m_pencarian->getpencarian($kkunci,$mulai,$batas);
					$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
					$hh = array(); $hh['Sunday']="Minggu"; $hh['Monday']="Senin"; $hh['Tuesday']="Selasa"; $hh['Wednesday']="Rabu"; $hh['Thursday']="Kamis"; $hh['Friday']="Jum'at"; $hh['Saturday']="Sabtu";

//////////////////////////////////
					foreach($data['hslquery'] as $key=>$val){
						@$data['hslquery'][$key]->seo=str_replace($d, '-', $val->judul);
						@$data['hslquery'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
						@$data['hslquery'][$key]->kat_seo=str_replace($d, '-', $val->nama_kategori);
						@$data['hslquery'][$key]->hari=$hh[$val->hari];
						@$data['hslquery'][$key]->kompponen=strtoupper($val->komponen);
					}
					$data['pager'] = Modules::run("web/pagerC",$dt['count'],$batas,$hal);
				}
		}
				echo json_encode($data);
	}

}