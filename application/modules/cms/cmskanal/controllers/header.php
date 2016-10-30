<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Header extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_kanal');
	}
	
	public function index(){
		echo $_POST['posisi'];

	}
///////////////////////////////////////////////////////////////////
/////////////////////////////LOGO HANDLING ////////////////////
	function logo_upload(){
		$data['kanal'] = $this->m_kanal->inikanal($_POST['id_konten']);
		$header = $this->m_kanal->get_header_kanal($_POST['id_konten']);
		$data['logo']=($header->nama_item=="")?base_url()."assets/media/logo_kanal/".$this->m_kanal->getopsivalue('logo_app'):base_url()."assets/media/logo_kanal/".$_POST['id_konten']."/".$header->nama_item;
		$this->load->view('kanal/logo_upload',$data);
	}


	function saveupload_logo(){
		$header = $this->m_kanal->get_header_kanal($_POST['id_konten']);
		if($header->nama_item!=""){	$this->hapus_logo_aksi($_POST['id_konten']);	}


		if(strlen($_FILES['artikel_file']['name'])>0){
				$id_konten = $_POST['id_konten'];
				$komponen = $_POST['komponen'];

			    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ');
				$ext = pathinfo($_FILES['artikel_file']['name'], PATHINFO_EXTENSION);
				$base = basename($_FILES['artikel_file']['name'], ".".$ext);
				$nms = str_replace($d,"_",$base);
				$nama_file = $nms.".".$ext;


				$result = $this->uploadFile_logo($id_konten,$_FILES['artikel_file'],$nama_file,$komponen);
				$nmB=str_replace($d, '_',$result['raw']);
				$nmF = $result['raw'].".".$ext;
				
				rename("assets/media/logo_kanal/".$id_konten."/".$nmF,"assets/media/logo_kanal/".$id_konten."/".$nama_file);

				if($result['status']=='error'){
					echo "error-<b>File gagal di upload</b> : <br />".$result['error'];
				}else{
					echo "success-".$result['idd'];
				}
		}else{
			echo "error-<b>Tidak ada file</b>";
		}
	}

	function uploadFile_logo($id_konten,$file,$nama_file,$komponen){
		$this->load->helper('file');
			$path="assets/media/logo_kanal/".$id_konten."/";
			if(!file_exists($path)){	mkdir($path,755);	}
		
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
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
			$this->m_kanal->simpan_logo_kanal($id_konten,$nama_file,$komponen);
			$data['raw'] = $ttpp;
			$data['status'] = "success";
			$data['idd'] = $id_konten;
			return $data;
		}
	}

	function hapus_logo(){
		$this->hapus_logo_aksi($_POST['idd']);
	}

	function hapus_logo_aksi($idd){
		$dfoto=$this->m_kanal->hapus_logo_aksi($idd); 
		unlink("assets/media/logo_kanal/".$idd."/$dfoto");
//		rmdir("assets/media/logo_kanal/".$idd);
	}

}
?>