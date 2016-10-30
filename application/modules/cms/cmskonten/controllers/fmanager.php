<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Fmanager extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_fmanager');
	}

	function index(){
		$data['satu']	= "Asset Manager";
		$data['setting']	= "fm";
		$this->load->view('fmanager/index',$data);
	}
	function getmedia(){
		$data['setting']	= "fm";
		$this->load->view('fmanager/getmedia',$data);
	}
	function pickmedia(){
		$data['setting']	= "fm";
		$this->load->view('fmanager/pickmedia',$data);
	}

	function getitem(){
///////////////////////////////////////////////////////CI 3.0//////////////////////////////
		$idppp=explode("_",$_POST['idparent']);	
		$idparent=end($idppp);	
///////////////////////////////////////////////////////////////////////////////////////////
		$level=($_POST['level']+1);
		$spare=3+(($level*15)-15);

		$data['isi']	= $this->m_fmanager->getitem($idparent);
		foreach($data['isi'] as $key=>$val){
			$jml = $this->m_fmanager->hitungfile($val->id_appe);
			$data['isi'][$key]->spare=$spare;	
			$data['isi'][$key]->level=$level;
				$anak=$this->m_fmanager->getitem($val->id_appe);
				$data['isi'][$key]->toggle=(!empty($anak))?"tutup":"buka";
				$data['isi'][$key]->idchild=($_POST['idparent']==0)?$val->id_appe:$_POST['idparent']."_".$val->id_appe;
				$data['isi'][$key]->cek=(empty($anak) && empty($jml))?"kosong":"ada";
			$data['isi'][$key]->banyak_file = $jml;
		}
		echo  json_encode($data);
	}
	function formtambah_folder(){
		$data['idparent']=$_POST['idparent'];
		$data['level']=$_POST['level'];

		$data['level']=$_POST['level'];
		$data['rowparent']=($_POST['idparent']=="0")?"":$_POST['idparent']."_";
		$data['parent']=($_POST['idparent']=="0")?"0":$_POST['idparent'];

		$this->load->view('fmanager/formtambah_folder',$data);
	}
	function tambah_folder_aksi(){
		$idp = explode("_",$_POST['idparent']);
		$id_parent = end($idp);
		$ang=explode("*",$_POST['nama_folder']);
			$ipp['folder'] = $ang[0];
			$ipp['keterangan'] = $ang[1];

		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$pth = str_replace($d, '',strtolower($ipp['folder']));
		
		$cek = $this->m_fmanager->cek_folder($id_parent,$pth);
		if(empty($cek)){
			if($id_parent==0){
				$path="assets/media/upload/".$pth."/";
				mkdir($path,755);
			} else {
				$path = "";
				foreach($idp AS $key=>$val){
					$iniF = $this->m_fmanager->ini_folder($val);
					$path = $path.$iniF->link."/";
				}
				$path = "assets/media/upload/".$path.$pth."/";
				mkdir($path,755);
			}
			$this->m_fmanager->tambah_folder_aksi($id_parent,$ipp,$pth);
		}
		echo "sukses#"."add#";
	}

	function formedit_folder(){
		$idp = explode("_",$_POST['idparent']);
		$id_parent = end($idp);
		
		$data['isi'] = $this->m_fmanager->ini_folder($id_parent);
		$data['idp'] = $_POST['idparent'];

		$this->load->view('fmanager/formedit_folder',$data);
	}

	function edit_folder_aksi(){
		$idp = explode("_",$_POST['idparent']);
		$nparent = count($idp)-2;
		$id_parent = ($nparent==-1)?0:$idp[$nparent];
		$id_ini = end($idp);
		$ang=explode("*",$_POST['nama_folder']);
			$ipp['folder'] = $ang[0];
			$ipp['keterangan'] = $ang[1];

		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$pth = str_replace($d, '',strtolower($ipp['folder']));
		$cek = $this->m_fmanager->cek_folder($id_parent,$pth);
		
		if(empty($cek)){
			$ini = $this->m_fmanager->ini_folder($id_ini);
			if(count($idp)==1){
				rename("assets/media/upload/".$ini->link."/","assets/media/upload/".$pth."/");
			} else {
				$path = "";
				for($i=0;$i<count($idp)-1;$i++){
					$iniF = $this->m_fmanager->ini_folder($idp[$i]);
					$path = $path.$iniF->link."/";
				}
				rename("assets/media/upload/".$path.$ini->link."/","assets/media/upload/".$path.$pth."/");
			}
			$this->m_fmanager->edit_folder_aksi($id_ini,$ipp,$pth);
		}
		echo "sukses#"."add";
	}

	function formhapus_folder(){
		$idp = explode("_",$_POST['idparent']);
		$id_parent = end($idp);
		
		$data['isi'] = $this->m_fmanager->ini_folder($id_parent);
		$data['idp'] = $_POST['idparent'];

		$this->load->view('fmanager/formhapus_folder',$data);
	}
	function hapus_folder_aksi(){
		$idp = explode("_",$_POST['idparent']);
		$id_ini = end($idp);

			$ini = $this->m_fmanager->ini_folder($id_ini);
			if(count($idp)==1){
				rmdir("assets/media/upload/".$ini->link."/");
			} else {
				$path = "";
				for($i=0;$i<count($idp)-1;$i++){
					$iniF = $this->m_fmanager->ini_folder($idp[$i]);
					$path = $path.$iniF->link."/";
				}
				rmdir("assets/media/upload/".$path.$ini->link."/");
			}
			$this->m_fmanager->hapus_folder_aksi($id_ini);

		echo "sukses#"."add";
	}
///////////////////////////////////////////////////////////////////
/////////////////////////////LAMPIRAN HANDLING ////////////////////
	function pilihmedia(){
		$idp = explode("_",$_POST['idparent']);
		$id_ini = end($idp);
		$ini = $this->m_fmanager->ini_folder($id_ini);
		if(count($idp)==1){
			$komponen = "assets/media/upload/".$ini->link."/";
		} else {
			$komponen = "";
			for($i=0;$i<count($idp)-1;$i++){
				$iniF = $this->m_fmanager->ini_folder($idp[$i]);
				$komponen = $komponen.$iniF->link."/";
			}
			$komponen = "assets/media/upload/".$komponen.$ini->link."/";
		}

		$idd = end($idp);
		$data['idp'] = $_POST['idparent'];
		$data['level'] = $_POST['level'];
		$data['folder'] = $this->m_fmanager->ini_folder($idd);
		$data['isi'] = $this->m_fmanager->getfile($idd);
		$data['idd'] = $idd;
		$data['path'] = $komponen;

		$this->load->view('fmanager/pilihmedia',$data);
	}
	function formmedia(){
		$idp = explode("_",$_POST['idparent']);
		$id_ini = end($idp);
		$ini = $this->m_fmanager->ini_folder($id_ini);
		if(count($idp)==1){
			$komponen = "assets/media/upload/".$ini->link."/";
		} else {
			$komponen = "";
			for($i=0;$i<count($idp)-1;$i++){
				$iniF = $this->m_fmanager->ini_folder($idp[$i]);
				$komponen = $komponen.$iniF->link."/";
			}
			$komponen = "assets/media/upload/".$komponen.$ini->link."/";
		}

		$idd = end($idp);
		$data['idp'] = $_POST['idparent'];
		$data['level'] = $_POST['level'];
		$data['folder'] = $this->m_fmanager->ini_folder($idd);
		$data['isi'] = $this->m_fmanager->getfile($idd);
		$data['idd'] = $idd;
		$data['path'] = $komponen;

		$this->load->view('fmanager/formmedia',$data);
	}
	function formfile(){
		$idp = explode("_",$_POST['idparent']);
		$id_ini = end($idp);
		$ini = $this->m_fmanager->ini_folder($id_ini);
		if(count($idp)==1){
			$komponen = "assets/media/upload/".$ini->link."/";
		} else {
			$komponen = "";
			for($i=0;$i<count($idp)-1;$i++){
				$iniF = $this->m_fmanager->ini_folder($idp[$i]);
				$komponen = $komponen.$iniF->link."/";
			}
			$komponen = "assets/media/upload/".$komponen.$ini->link."/";
		}

		$idd = end($idp);
		$data['idp'] = $_POST['idparent'];
		$data['level'] = $_POST['level'];
		$data['folder'] = $this->m_fmanager->ini_folder($idd);
		$data['isi'] = $this->m_fmanager->getfile($idd);
		$data['idd'] = $idd;
		$data['path'] = $komponen;

		$this->load->view('fmanager/formfile',$data);
	}
	function saveupload(){
		if(strlen($_FILES['artikel_file']['name'])>0){
			$id_konten = $_POST['id_konten'];
			$komponen = $_POST['path'];

			    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
				$ext = pathinfo($_FILES['artikel_file']['name'], PATHINFO_EXTENSION);
				$base = basename($_FILES['artikel_file']['name'], ".".$ext);
				$nama_file = str_replace($d,"_",$base).".".$ext;

				if(!file_exists($komponen.$nama_file)){
							$result = $this->upload($id_konten,$_FILES['artikel_file'],$nama_file,$komponen,$ext);
							////////////////////////////////
							$nmF = $result['raw'].".".$ext;
							rename($komponen.$nmF,$komponen.$nama_file);
							////////////////////////////////
							if($result['status']=='error'){
								echo "error-<b>File gagal di upload</b> : <br />".$result['error'];
							}else{
								echo "success-".$result['idd'];
							}
				} else {echo "success-";}

		}else{
			echo "error-<b>Tidak ada file</b>";
		}
	}
	function upload($id_konten,$file,$nama_file,$komponen,$ext){
		$this->load->helper('file');
		$config['upload_path'] = $komponen;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg|pdf|xls|xlsx|doc|docx';
//		$config['max_size']	= '512';
		$config['remove_spaces']=true;
        $config['overwrite']=true;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('artikel_file'))		{
			$data= array('status' => 'error', 'error' => $this->upload->display_errors());
			return $data;
		}	else {
			$dn = $this->upload->data('artikel_file');
			$ttpp = $dn['raw_name'];
			$this->m_fmanager->simpan_file($id_konten,$nama_file,$ext);
			$data['raw'] = $ttpp;
			$data['status'] = "success";
			$data['idd'] = $id_konten;
			return $data;
		}
	}

	function formfile_hapus(){
		unlink($_POST['path']."/".$_POST['file']);
		$this->m_fmanager->hapus_folder_aksi($_POST['idd']);
		echo "sukses#"."add#";
	}
	function formfile_rename(){
		$ini = $this->m_fmanager->ini_folder($_POST['idd']);

	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
		$nama_baru = str_replace($d,"_",$_POST['isi']);
		if(!file_exists($_POST['path'].$nama_baru.".".$ini->keterangan_appe)){
			$baru = $nama_baru.".".$ini->keterangan_appe;
			rename($_POST['path'].$ini->judul_appe,$_POST['path'].$baru);
			$this->m_fmanager->rename_fl($_POST['idd'],$baru);
		}
		echo "sukses#"."add#";
	}

}
?>