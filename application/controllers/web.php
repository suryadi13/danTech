<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->session->set_userdata('visit');
		$this->load->model('m_web');
		$this->load->library("paging");
	}	

	public function index(){
			$sessn = $this->defaultkanal();
				$sessm['kanal'] = $sessn->path_kanal;
				$sessm['tipe_kanal'] = $sessn->tipe;
				$sessm['theme'] = $sessn->theme;
				$sessm['id_kanal'] = $sessn->id_kanal;
			$this->session->set_userdata('visit', $sessm);

			$data['nama_app']=$this->m_web->getopsivalue('nama_app');
			$data['slogan_app']=$this->m_web->getopsivalue('slogan_app');
			$data['favicon_app']=$this->m_web->getopsivalue('favicon_app');
			$data['cTop']="";$norut=1;
			$gg=$this->m_web->getwrapper($sessn->path_kanal,"topbar");
			foreach($gg->widget as $key=>$val){	$data['cTop'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);	$norut++;}
			$data['cMain']="";
			$gg=$this->m_web->getwrapper($sessn->path_kanal,"mainbar");
			foreach($gg->widget as $key=>$val){	$data['cMain'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);		$norut++;}
			$data['cSide']="";
			$gg=$this->m_web->getwrapper($sessn->path_kanal,"sidebar");
			foreach($gg->widget as $key=>$val){	$data['cSide'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);		$norut++;}
			$data['cHeader'] = Modules::run("html_var/header/index");
			$data['cNav'] = Modules::run("html_var/navbar/index","0");
			$data['cFooter'] = Modules::run("html_var/footer/index");
			$this->viewPath = '../../assets/themes/'.$sessm['theme'].'/';
			$this->load->view($this->viewPath.'index',$data);
	}

	public function kanal(){
		if($this->uri->segment(2)==""){
			redirect(site_url());
		} else {
			$sessn = $this->carikanal($this->uri->segment(2));
			if(!@$sessn->path_kanal){
				redirect(site_url());
			} else {
				$sessm['kanal'] = @$sessn->path_kanal;
				$sessm['tipe_kanal'] = @$sessn->tipe;
				$sessm['theme'] = @$sessn->theme;
				$sessm['id_kanal'] = @$sessn->id_kanal;
				$this->session->set_userdata('visit', $sessm);

				$data['nama_app']=$this->m_web->getopsivalue('nama_app');
				$data['slogan_app']=$this->m_web->getopsivalue('slogan_app');
				$data['favicon_app']=$this->m_web->getopsivalue('favicon_app');
		
				$data['cTop']="";$norut=1;
				$gg=$this->m_web->getwrapper($this->uri->segment(2),"topbar");
				foreach($gg->widget as $key=>$val){	$data['cTop'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);		$norut++;}
				$data['cMain']="";
				$gg=$this->m_web->getwrapper($this->uri->segment(2),"mainbar");
				foreach($gg->widget as $key=>$val){	$data['cMain'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);		$norut++;}
				$data['cSide']="";
				$gg=$this->m_web->getwrapper($this->uri->segment(2),"sidebar");
				foreach($gg->widget as $key=>$val){	$data['cSide'].=  Modules::run("widget_".$val->nama_widget,$val->nama_wrapper,$val->id_kategori,$val->opsi,$norut);		$norut++;}

				$data['cHeader'] = Modules::run("html_var/header/index");
				$data['cNav'] = Modules::run("html_var/navbar/index","0");
				$data['cFooter'] = Modules::run("html_var/footer/index");
				$this->viewPath = '../../assets/themes/'.$sessm['theme'].'/';
				$this->load->view($this->viewPath.'index',$data);
			}
		}
	}

	public function detail(){
		$pil = $this->m_web->get_komponen();
		if(!in_array($this->uri->segment(2),$pil)){
			redirect(site_url()."404");
		} else {
			$data['nama_app']=str_replace("-"," ",$this->uri->segment(4));
			$data['slogan_app']=str_replace("-"," ",$this->uri->segment(5));
			$data['favicon_app']=$this->m_web->getopsivalue('favicon_app');

			$data['cMain'] = Modules::run("web_".$this->uri->segment(2)."/".$this->uri->segment(1)."",$this->uri->segment(4),$this->uri->segment(3));
			$data['cSide'] = Modules::run("web_".$this->uri->segment(2)."/".$this->uri->segment(1)."_side");
			$data['cTop']="";
			$data['cHeader'] = Modules::run("html_var/header/index");
			$data['cNav'] = Modules::run("html_var/navbar/index","0");
			$data['cFooter'] = Modules::run("html_var/footer/index");

			$sess = $this->session->userdata('visit');
			$this->viewPath = '../../assets/themes/'.$sess['theme'].'/';
			$this->load->view($this->viewPath.'index',$data);
		}
	}


	public function all(){
		$pil = $this->m_web->get_komponen();
		if(!in_array($this->uri->segment(2),$pil)){
			redirect(site_url());
		} else {
			$data['cMain'] = Modules::run("web_".$this->uri->segment(2)."/".$this->uri->segment(1)."",$this->uri->segment(4),$this->uri->segment(3));
			$data['cSide'] = Modules::run("web_".$this->uri->segment(2)."/".$this->uri->segment(1)."_side");
			$data['cTop'] = "";
			$data['cHeader'] = Modules::run("html_var/header/index");
			$data['cNav'] = Modules::run("html_var/navbar/index","0");
			$data['cFooter'] = Modules::run("html_var/footer/index");

			$data['nama_app']="Index";
			$data['slogan_app']=str_replace("-"," ",$this->uri->segment(5));
			$data['favicon_app']=$this->m_web->getopsivalue('favicon_app');

			$sess = $this->session->userdata('visit');
			$this->viewPath = '../../assets/themes/'.$sess['theme'].'/';
			$this->load->view($this->viewPath.'index',$data);
		}
	}

	public function cari(){
 		$this->form_validation->set_rules("kata_kunci","Kata kunci","required|xss_clean");
		if($this->form_validation->run()) {
//			$sessn = $this->m_web->main_kanal();
			$sessn = $this->defaultkanal();
			$sessm['kanal'] = @$sessn->path_kanal;
			$sessm['tipe_kanal'] = @$sessn->tipe;
			$sessm['theme'] = (@$sessn->theme=="")?"web":@$sessn->theme;
			$sessm['id_kanal'] = @$sessn->id_kanal;
			$sessm['kata_kunci'] = $this->input->post('kata_kunci');
			$this->session->set_userdata('visit', $sessm);

			$data['nama_app']=$this->m_web->getopsivalue('nama_app');
			$data['slogan_app']=$this->m_web->getopsivalue('slogan_app');
			$data['favicon_app']=$this->m_web->getopsivalue('favicon_app');
	
			$data['cTop']="";
			$data['cMain']=Modules::run("widget_pencarian/index");
			$data['cSide']="";
	
			$data['cHeader'] = Modules::run("html_var/header/index");
			$data['cNav'] = Modules::run("html_var/navbar/index","0");
			$data['cFooter'] = Modules::run("html_var/footer/index");
			$this->viewPath = '../../assets/themes/'.$sessm['theme'].'/';
			$this->load->view($this->viewPath.'index',$data);
		} else {
			redirect(site_url()."404");
		}
	}
////////////////////////////////////////////////////////////////////
///////////////           Load Pager Grid     //////////////////////
	function pagerA($n_itmsrch,$bat,$hal,$bat_page=2) {
		$page=$this->paging->halaman($n_itmsrch,$bat,$hal,$bat_page);
		$vala="<div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}
/////////////////////////////khusus SEO
	function pagerB($n_itmsrch,$bat,$hal,$bat_page=5) {
		$page=$this->paging->halamanB($n_itmsrch,$bat,$hal,$bat_page);
		$iptx="<input id='inputpaging' type='text' style='text-align:right; border:1px solid #3399CC; padding:0px 2px 0px 2px;' size='2' value='".$hal."' onblur=\"if(this.value=='') this.value='".$hal."';\" onfocus=\"if(this.value=='".$hal."') this.value='';\">";
		$vala="<div style='float:left; padding:4px 3px 3px 0px;'>Hal.</div><div style='float:left; padding-top:2px;'>".$iptx."</div><div style='float:left; padding:4px 3px 3px 3px;'>dari ".$page['b_halmax']."</div><div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}
//////////////////////////////
	function pagerC($n_itmsrch,$bat,$hal,$bat_page=5) {
		$page=$this->paging->halaman($n_itmsrch,$bat,$hal,$bat_page);
		$iptx="<input id='inputpaging' type='text' style='text-align:right; border:1px solid #3399CC; padding:0px 2px 0px 2px;' size='2' value='".$hal."' onblur=\"if(this.value=='') this.value='".$hal."';\" onfocus=\"if(this.value=='".$hal."') this.value='';\">";
		$vala="<div style='float:left; padding:4px 3px 3px 0px;'>Hal.</div><div style='float:left; padding-top:2px;'>".$iptx."</div><div style='float:left; padding:4px 3px 3px 3px;'>dari ".$page['b_halmax']."</div><div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}
////////////////////////////////////////////////////////////////////
	public function carikanal($kanalpath="home"){
		$ctpl = $this->m_web->carikanal($kanalpath);
		return $ctpl;
	}
	public function defaultkanal(){
		$ctpl = $this->m_web->defaultkanal();
		return $ctpl;
	}
	public function root_kanal($id_kanal)	{
		$iniroot="";
		$jkanal=explode("**",$this->m_web->root_kanal($id_kanal));
		for($i=0;$i<count($jkanal)-1;$i++){
			$kanali=explode("*",$jkanal[$i]);
			$iniroot= $iniroot."<li><a href='".site_url()."kanal/".@$kanali[2]."'>".@$kanali[1]."</a></li>";
		}
		return $iniroot;
	}
	public function cari_kanal($id_kanal)	{
		$ckanal	= $this->m_web->cari_kanal($id_kanal);
		return $ckanal;
	}
	public function ikanal($id_kategori)	{
		$ckanal	= $this->m_web->ikanal($id_kategori);
		return $ckanal;
	}
////////////////////////////////////////////////////////////////////
	function counter($idd) {
		$this->m_web->counter($idd);
	}
////////////////////////////////////////////////////////////////////
}