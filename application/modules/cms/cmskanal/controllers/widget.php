<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Widget extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	public function index(){
		$data['ini_kanal'] = $this->m_kanal->inikanal($_POST['id_kanal']);
		$data['wrapper'] = $this->m_kanal->getwrapper($data['ini_kanal']->path_kanal,$_POST['posisi']);
		foreach($data['wrapper']->widget AS $key=>$val){
			$widget = $this->m_kanal->ini_item($val->id_widget);
			$jj = json_decode($widget[0]->meta_value);
			@$data['wrapper']->widget[$key]->custom = (isset($jj->custom))?"ya":"tidak";
		}
		$data['posisi'] = $_POST['posisi'];
		$this->load->view('widget/index',$data);
	}
	public function urutan_wrapper_aksi(){
		$this->m_kanal->urutan_wrapper_aksi($_POST);
		$data['ini_kanal'] = $this->m_kanal->inikanal($_POST['id_kanal']);
		$data['wrapper'] = $this->m_kanal->getwrapper($data['ini_kanal']->path_kanal,$_POST['posisi']);
		$data['posisi'] = $_POST['posisi'];
		$this->load->view('widget/index',$data);
	}
	public function fitur_widget(){
		$data['path_kanal'] = $_POST['path_kanal'];
		$data['posisi'] = $_POST['posisi'];
		$data['urutan'] = $_POST['urutan'];

		$wrapper = $this->m_kanal->getwrapper($data['path_kanal'],$data['posisi']);
		$widget = $wrapper->widget;
		$iWidget = $widget[$data['urutan']];
		$data['nama_widget'] = $iWidget->nama_widget;

		$data['isi'] = Modules::run("widget_".$iWidget->nama_widget."/formadmin/formfitur",$iWidget->id_widget,$iWidget->id_kategori,$iWidget->opsi);
		$this->load->view('widget/fitur_widget',$data);
	}


	public function formtambahwidget(){
		$data['idd']=$_POST['idd'];
		$data['id_kanal']=$_POST['id_kanal'];
		$data['posisi']=$_POST['pos'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$row=$this->m_kanal->getwidget_posisi($data['posisi']);
		$data['widget']="";
		$data['id_kategori']="{}";
		foreach($row as $key=>$val){
			$data['widget'].="<option value='".$val->id_item."'>".$val->nama_item."";
		}
		$this->load->view('widget/formtambahwidget',$data);
	}
	public function tambahwidget_aksi(){
		$ipp = $_POST;

				$knl = $this->m_kanal->ini_item($ipp['idk']);
				$kanal = json_decode($knl[0]->meta_value);
				$path = $kanal->path_kanal;
		$ada = $this->m_kanal->getwrapper_kanal($ipp['idk'],$ipp['lokasi']);
				$widget = $this->m_kanal->ini_item($ipp['id_widget']);
				$yu="";
				foreach($ipp['widget_isi'] AS $key=>$val){	$yu.= ($key==0) ? $val : ",".$val;	}
				$ni = "[";
				foreach($ipp['nilai'] AS $key=>$val){	$ni.= ($key==0) ? "{\"label\":\"".$ipp['label'][$key]."\",\"nama\":\"".$ipp['nama'][$key]."\",\"nilai\":\"".$ipp['nilai'][$key]."\"}" : ",{\"label\":\"".$ipp['label'][$key]."\",\"nama\":\"".$ipp['nama'][$key]."\",\"nilai\":\"".$ipp['nilai'][$key]."\"}";	}
				$ni.= "]";
				$ini="{\"nama_widget\":\"".$widget[0]->nama_item."\",\"id_widget\":\"".$ipp['id_widget']."\",\"nama_wrapper\":\"".$ipp['nama_wrapper']."\",\"id_kategori\":\"".$yu."\",\"keterangan\":\"".$ipp['keterangan']."\",\"opsi\":".$ni."}";
		
		if(empty($ada)){
				$kn = "{\"id_kanal\":\"".$ipp['idk']."\",\"path_kanal\":\"".$path."\",\"widget\":[".$ini."]}";
				$this->m_kanal->input_wrapper_aksi($ipp['lokasi'],$kn);
				$ipp['idd']=0;
		} else {
				$jj = json_decode($ada->meta_value);
				$yy="";
				foreach($jj->widget AS $key=>$val){
					$wi=json_encode($val);
					$yy.= ($key==0)?$wi:",".$wi;
				}
				$kn = "{\"id_kanal\":\"".$ipp['idk']."\",\"path_kanal\":\"".$path."\",\"widget\":[".$yy.",".$ini."]}";
				$this->m_kanal->edit_wrapper_aksi($ada->id_item,$kn); 
				$ipp['idd']=$key+1;
		}
		$this->m_kanal->kendali_kategori($ipp); 

		echo $kn;
	}

	public function formeditwidget(){
		$data['id_kanal']=$_POST['id_kanal'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$data['posisi']=$_POST['pos'];
		$data['idd']=$_POST['idd'];
		$data['widget']=$this->m_kanal->getwidgetkanal_urutan($_POST['pos'],$_POST['id_kanal'],$_POST['idd']);
		$data['id_kategori']=@$data['widget']->id_kategori;
		$data['opsi']="";
		foreach(@$data['widget']->opsi AS $key=>$val){
			$data['opsi'].=($key==0)?$val->nilai:",".$val->nilai;
		}
		$this->load->view('widget/formeditwidget',$data);
	}
	public function editwidget_aksi(){
		$ipp = $_POST;

				$knl = $this->m_kanal->ini_item($ipp['idk']);
				$kanal = json_decode(@$knl[0]->meta_value);
				$path = @$kanal->path_kanal;

				$widget = $this->m_kanal->ini_item($ipp['id_widget']);
				$yu="";
				foreach($ipp['widget_isi'] AS $key=>$val){	$yu.= ($key==0) ? $val : ",".$val;	}
				$ni = "[";
				foreach($ipp['nilai'] AS $key=>$val){	$ni.= ($key==0) ? "{\"label\":\"".$ipp['label'][$key]."\",\"nama\":\"".$ipp['nama'][$key]."\",\"nilai\":\"".$ipp['nilai'][$key]."\"}" : ",{\"label\":\"".$ipp['label'][$key]."\",\"nama\":\"".$ipp['nama'][$key]."\",\"nilai\":\"".$ipp['nilai'][$key]."\"}";	}
				$ni.= "]";
				$ini="{\"nama_widget\":\"".$widget[0]->nama_item."\",\"id_widget\":\"".$ipp['id_widget']."\",\"nama_wrapper\":\"".$ipp['nama_wrapper']."\",\"id_kategori\":\"".$yu."\",\"keterangan\":\"".$ipp['keterangan']."\",\"opsi\":".$ni."}";

		$wi = $this->m_kanal->getwrapper_kanal($ipp['idk'],$ipp['lokasi']);
		$jj = json_decode($wi->meta_value);
		$yi="";
		foreach($jj->widget AS $key=>$val){
			$pisah=($key==0)?"":",";
			$yi.= ($key==$ipp['idd'])?$pisah.$ini:$pisah.json_encode($val);
		}

		$kn = "{\"id_kanal\":\"".$ipp['idk']."\",\"path_kanal\":\"".$path."\",\"widget\":[".$yi."]}";

		$this->m_kanal->edit_wrapper_aksi($wi->id_item,$kn); 
		$this->m_kanal->kendali_kategori($ipp); 
		echo $kn;
	}

	public function formhapuswidget(){
		$data['id_kanal']=$_POST['id_kanal'];
		$data['idgh']=($_POST['id_kanal']=="")?"":$_POST['id_kanal'];
		$data['posisi']=$_POST['pos'];
		$data['idd']=$_POST['idd'];
		$data['widget']=$this->m_kanal->getwidgetkanal_urutan($_POST['pos'],$_POST['id_kanal'],$_POST['idd']);
		$data['id_kategori']=@$data['widget']->id_kategori;
		
		$this->load->view('widget/formhapuswidget',$data);
	}

	public function hapuswidget_aksi(){
		$ipp = $_POST;

				$knl = $this->m_kanal->ini_item($ipp['idk']);
				$kanal = json_decode($knl[0]->meta_value);
				$path = $kanal->path_kanal;
		$wi = $this->m_kanal->getwrapper_kanal($ipp['idk'],$ipp['lokasi']);
		$jj = json_decode($wi->meta_value);
		$yi="";$hy=0;
		foreach($jj->widget AS $key=>$val){
			if($key!=$ipp['idd']){
				$pisah=($hy==0)?"":",";
				$yi.= $pisah.json_encode($val);
				$hy++;
			}
		}
		$kn = "{\"id_kanal\":\"".$ipp['idk']."\",\"path_kanal\":\"".$path."\",\"widget\":[".$yi."]}";
		if($hy!=0){
			$this->m_kanal->edit_wrapper_aksi($wi->id_item,$kn); 
		} else {
			$this->m_kanal->hapus_wrapper_aksi($wi->id_item,$kn); 
		}
		$this->m_kanal->kendali_kategori_hapus($ipp); 
		echo $kn;
	}

}
?>