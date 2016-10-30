<?php
class Admin extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
	}

	public function index(){ 
		$sess = $this->session->userdata('logged_in');
		$menu = $this->get_group_menu($sess['id_group']);
		redirect(site_url('admin/'.$menu[0]->path_menu));
	}
	public function module($modulename,$contrr)	{
		if($contrr==""){	redirect(site_url('admin'));	}else{
		$sess = $this->session->userdata('logged_in');
		/* Contoh untuk bikin tampilan identitas pengguna 
		Bisa saja dikasih foto, nama dlll
		*/		
		$data['pengenal'] = $this->pengenal();
		
		$fni = ($this->uri->segment(5)=="")?"":"/".$this->uri->segment(5);
		$induk = $this->induk($modulename."/".$contrr.$fni);
		$data['actt'] = $this->session->userdata('menu_induk_aktif');

		$data['logo'] = $this->getopsivalue('logo_app');
		$data['nama'] = $this->getopsivalue('nama_app');
		$data['slogan'] = $this->getopsivalue('slogan_app');

		$data['sidebar'] = $this->get_group_menu($sess['id_group']);
		$data['konten'] = ($this->uri->segment(5)=="")?Modules::run($modulename."/".$contrr."/index"):Modules::run($modulename."/".$contrr."/".$this->uri->segment(5));	//$data['konten'] =   Modules::run($modulename."/index");

		$data['gr'] = $this->getgroupvar($sess['id_group']);
		$data['notif'] =   Modules::run('cmsadmin/notif/'.$sess['group_name']);
			
		$this->viewPath = '../../assets/themes/'. $sess['section_name'].'/';
		$this->load->view($this->viewPath.'index',$data);
		}
	}
/////////////////////////////////////////////////////////
	public function get_group_menu($id_groups,$id_menu=0){
		$sqlstr="SELECT a.* FROM cmf_setting a WHERE a.id_setting='12' AND a.id_parent='$id_menu' ORDER BY a.urutan ASC";
		$hslquery=$this->db->query($sqlstr)->result();

		$data=array();$ky=0;
		foreach($hslquery as $key=>$val){
			$sqlstrb="SELECT a.id_item FROM cmf_setting a WHERE a.id_setting='14' AND a.meta_value LIKE '%\"id_menu\":\"".$val->id_item."\"%'  AND a.meta_value LIKE '%\"group_id\":\"$id_groups\"%'";
			$hslqueryb=$this->db->query($sqlstrb)->row();
			if(!empty($hslqueryb)){	
				$jj=json_decode($val->meta_value);
				@$data[$ky]->id_menu = $val->id_item;
				$data[$ky]->nama_menu = $val->nama_item;
				$data[$ky]->path_menu = $jj->path_menu;
				$data[$ky]->icon_menu = $jj->icon_menu;
					$anak = $this->get_group_menu($id_groups,$val->id_item);
					if(!empty($anak)){	$data[$ky]->anak = $anak;	}	
				$ky++;
			}
		}
		return $data;
	}
	function getopsivalue($nama){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_setting' => '1','nama_item' => $nama))->row();
		$ff=json_decode(@$hslqueryp->meta_value);
		return @$ff->nilai;
	}
	function getgroupvar($idd){
		$hslqueryp = $this->db->get_where('cmf_setting', array('id_item' => $idd))->row();
		$ff=json_decode(@$hslqueryp->meta_value);
		return $ff;
	}

	function pindah(){
		$ids = $this->session->userdata('logged_in');
		echo $ids['id_user'];
	}

	private function pengenal()	{
		/*Buat script disini untuk nampilin foto dan identitas user*/
		$sess = $this->session->userdata('logged_in');
		$tanda = "<div class='user-dantech'>".$sess['nama_user']."</div>";
		return $tanda;
	}

	private function induk($urr)	{
		$urr = "module/".$urr;
		$sqlstr="SELECT meta_value,nama_item,id_item,urutan FROM cmf_setting  WHERE id_setting='12' AND meta_value LIKE '%\"path_menu\":\"$urr\"%'";
		$hslquery=$this->db->query($sqlstr)->row();
		if(empty($hslquery)){	$balik="TIDAK ADA";	} else {	
			$balik = $this->cari_induk($hslquery->id_item);
			$this->session->set_userdata('menu_induk_aktif',$balik);
		}
		return $balik;
	}
	private function cari_induk($idd)	{
		$sqlstr="SELECT a.id_item,a.id_parent FROM cmf_setting a WHERE a.id_item='$idd'";
		$hslquery=$this->db->query($sqlstr)->row();
		if($hslquery->id_parent==0){
			return $hslquery->id_item;
		} else {
			$ulang=$this->cari_induk($hslquery->id_parent);
			return $ulang;
		}
	}

}