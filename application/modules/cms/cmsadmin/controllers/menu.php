<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Menu extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_menu');
	}

	function index(){
		$data['setting']	= "Menu";
		$this->load->view('menu/index',$data);
	}

	function getmenu(){
///////////////////////////////////////////////////////CI 3.0//////////////////////////////
		$idppp=explode("_",$_POST['idparent']);	
		$idparent=end($idppp);	
///////////////////////////////////////////////////////////////////////////////////////////
		$level=($_POST['level']+1);
		$spare=3+(($level*15)-15);

		$data['isi']	= $this->m_menu->getitem(12,$idparent);
		foreach($data['isi'] as $key=>$val){
			$jj=json_decode($val->meta_value);

			$data['isi'][$key]->spare=$spare;	
			$data['isi'][$key]->level=$level;
			$data['isi'][$key]->path_menu=$jj->path_menu;
			$data['isi'][$key]->icon_menu=$jj->icon_menu;
			$data['isi'][$key]->keterangan=$jj->keterangan;
				$anak=$this->m_menu->getitem(12,$val->id_item);
				$data['isi'][$key]->toggle=(!empty($anak))?"tutup":"buka";
				$data['isi'][$key]->idchild=($_POST['idparent']==0)?$val->id_item:$_POST['idparent']."_".$val->id_item;
				$cek = $this->m_menu->cek_menu($val->id_item);
				$data['isi'][$key]->cek=(empty($cek) & empty($anak))?"kosong":"ada";
		}
		echo  json_encode($data);
	}
	function formtambah_menu(){
		$data['idparent']=$_POST['idparent'];
		$data['level']=$_POST['level'];

		$data['level']=$_POST['level'];
		$data['rowparent']=($_POST['idparent']=="0")?"":$_POST['idparent']."_";
		$data['parent']=($_POST['idparent']=="0")?"0":$_POST['idparent'];

		$this->load->view('menu/formtambah_menu',$data);
	}

	function tambah_menu_aksi(){
		$id_parent=end(explode("_",$_POST['idparent']));
		$ang=explode("*",$_POST['nama_menu']);
			$ipp['menu_name']=$ang[0];
			$ipp['icon_menu']=$ang[1];
			$ipp['menu_path']=$ang[2];
			$ipp['keterangan']=$ang[3];
		$this->m_menu->tambah_menu_aksi($id_parent,$ipp);
		echo "sukses#"."add#";
	}
	function formedit_menu(){
		$data['id_menu']=$_POST['idd'];
		$data['idparent']=$_POST['idparent'];
		$data['level']=($_POST['idparent']=="0")?"0":$_POST['level'];
		$data['rowparent']=($_POST['idparent']=="0")?"":$_POST['idparent']."_";
		$data['parent']=($_POST['idparent']=="0")?"0":$_POST['idparent'];
		$rt = explode("_",$_POST['idd']);
		$data['idd']=end($rt);
		$hslquery=$this->m_menu->ini_item($data['idd']);
			$jj = json_decode($hslquery[0]->meta_value);
		@$data['hslquery'][0]->menu_name=$hslquery[0]->nama_item;
		$data['hslquery'][0]->menu_path=$jj->path_menu;
		$data['hslquery'][0]->icon_menu=$jj->icon_menu;
		$data['hslquery'][0]->keterangan=$jj->keterangan;
		$this->load->view('menu/formedit_menu',$data);
	}
	function edit_menu_aksi(){
		$idd=$_POST['idd'];
		$ang=explode("*",$_POST['nama_menu']);
			$ipp['menu_name']=$ang[0];
			$ipp['icon_menu']=$ang[1];
			$ipp['menu_path']=$ang[2];
			$ipp['keterangan']=$ang[3];
		$this->m_menu->edit_menu_aksi($idd,$ipp);
	}
	function formhapus_menu(){
		$rt = explode("_",$_POST['idd']);
		$data['idd']=end($rt);
		$data['idparent']=$_POST['idparent'];

		if($_POST['level']==1){
			$data['level']=0;
			$data['rowparent']="";
			$data['parent']=0;
		} else {
			$idp=explode("_",$_POST['idd']);
			$isi	= $this->m_menu->getitem(2,$_POST['idparent']);
			$data['rowparent']="";
			$data['parent']="";
			if(count($isi)==1){
				$data['level']=$_POST['level']-2;
				for($i=0;$i<count($idp)-2;$i++){	$data['rowparent'].=$idp[$i]."_";	$data['parent'].=($i==0)?$idp[$i]:"_".$idp[$i];	}
			} else {
				$data['level']=$_POST['level']-1;
				for($i=0;$i<count($idp)-1;$i++){	$data['rowparent'].=$idp[$i]."_";	$data['parent'].=($i==0)?$idp[$i]:"_".$idp[$i];	}
			}
			if($data['parent']==""){$data['parent']=0;}
		}

		$hslquery=$this->m_menu->ini_item($data['idd']);
			$jj = json_decode($hslquery[0]->meta_value);
		@$data['hslquery'][0]->menu_name=$hslquery[0]->nama_item;
		$data['hslquery'][0]->menu_path=$jj->path_menu;
		$data['hslquery'][0]->icon_menu=$jj->icon_menu;
		$data['hslquery'][0]->keterangan=$jj->keterangan;

		$this->load->view('menu/formhapus_menu',$data);
	}

	function hapus_menu_aksi($id_setting=2){
		$idd=$_POST['idd'];
		$this->m_menu->hapus_item_aksi($idd);
///////////////////////////////////////////////////////CI 3.0//////////////////////////////
		$idppp=explode("_",$_POST['idparent']);	
		$idparent=end($idppp);	
///////////////////////////////////////////////////////////////////////////////////////////
		$this->m_menu->reurut($id_setting,$idparent);
		echo "sukses#"."add#";
	}





	function menu_grup(){
		$data['setting']	= "Menu Pengguna";
		$data['setting_ref']	= "Menu";

		$data['id_setting']	= 14;
		$data['id_setting_ref']	= 12;
		$grup = Modules::run("cmsadmin/user/getusergroup");
		$data['grup'] = json_decode($grup);

		$this->load->view('menu/menu_grup',$data);
	}

	function getmenupengguna(){
		$group_id	= $_POST['group_id'];
		$id_setting	= $_POST['id_setting'];
		$id_setting_ref	= $_POST['id_setting_ref'];
///////////////////////////////////////////////////////CI 3.0//////////////////////////////
		$idppp=explode("_",$_POST['idparent']);	
		$idparent=end($idppp);	
///////////////////////////////////////////////////////////////////////////////////////////
		$level=($_POST['level']+1);
		$spare=3+(($level*15)-15);

		$data['isi']	= $this->m_menu->getmenupengguna($id_setting,$id_setting_ref,$idparent,$group_id);

		foreach($data['isi'] as $key=>$val){
			$id=$val->id_item;//////////////
			$jj=json_decode($val->meta_value);
			$data['isi'][$key]->icon_menu=$jj->icon_menu;
			$data['isi'][$key]->path_menu=$jj->path_menu;
			$data['isi'][$key]->keterangan=$jj->keterangan;

			$data['isi'][$key]->spare=$spare;	
			$data['isi'][$key]->level=$level;
				$anak=$this->m_menu->getmenupengguna($id_setting,$id_setting_ref,$id,$group_id);
				$data['isi'][$key]->toggle=(!empty($anak))?"tutup":"buka";
				$data['isi'][$key]->idchild=($_POST['idparent']==0)?$id:$_POST['idparent']."_".$id;
		}

		echo  json_encode($data);
	}
	function formtambah_menu_pengguna(){
		$data['id_setting'] = $_POST['id_setting'];
		$data['id_setting_ref'] = $_POST['id_setting_ref'];
		$data['group_id'] = $_POST['group_id'];
			$grup = $this->m_menu->detail_grup($_POST['group_id']);
		$data['nama_group']=$grup[0]->group_name;
		$this->load->view('menu/formtambah_menu_pengguna',$data);
	}
	function getmenuuserAll(){
		$gg = $this->getpanggilmenu(12,0,1,"","",$_POST['id_setting'],$_POST['id_setting_ref'],$_POST['group_id']);
		echo $gg;
	}
	function tambah_menu_pengguna_aksi(){
		$ang=explode("_",$_POST['menu']);
		$this->m_menu->tambah_menu_pengguna_aksi($_POST['group_id'],$_POST['id_setting'],$ang);
	}
	function getpanggilmenu($sett,$idp,$level=1,$ni="",$di="",$set,$set_ref,$grup){
		$gh	= $this->m_menu->getitem($sett,$idp);
		if(!empty($gh)){
		$bb="";
		$no=1;
			foreach($gh as $key=>$val){
				$spare=3+(($level*20)-15);
				if($ni!=""){$na=$ni.".".$no;}else{$na=$no;}
				if($di!=""){$da=$di."_".$val->id_item;}else{$da=$val->id_item;}
				if(($no % 2) == 1){$seling="odd";}else{$seling="even";}
				$ghh = $this->m_menu->getitem($sett,$val->id_item);
				$jj = json_decode($val->meta_value);
					$bb .= "<tr class=\"gridrow ".$seling."\" height=20>";
					$bb .= "<td class=\"gridcell left\" align=\"left\"><b><div id=\"nomer_".$val->id_item."\">".$na."</div></b></td>";
				if(empty($ghh)){
					$cek = $this->m_menu->cekmenupengguna($val->id_item,$set,$set_ref,$grup);
					if(empty($cek)){
						$bb .= "<td class=\"gridcell\"><input type=checkbox id='ccshdk_".$val->id_item."' name='menu_path' value='".$da."'></td>";
					} else {
						$bb .= "<td class=\"gridcell\">&nbsp;</td>";
					}
					$bb .= "<td class=\"gridcell\" style=\"padding-left: ".$spare."px;\"><div class=\"ui-icon ui-icon-document-b tree-leaf treeclick\" style=\"float: left;\"></div>".$val->nama_item."</td>";
					$bb .= "<td class=\"gridcell\">".$jj->keterangan."</td>";
					$bb .= "</tr>";
				} else {
					$bb .= "<td class=\"gridcell\">&nbsp;</td>";
					$bb .= "<td class=\"gridcell\" style=\"padding-left: ".$spare."px;\"><div class=\"ui-icon treeclick ui-icon-triangle-1-s tree-minus\" style=\"float: left;\"></div>".$val->nama_item."</td>";
					$bb .= "<td class=\"gridcell\">".$jj->keterangan."</td>";
					$bb .= "</tr>";
					$ne = 1;
					foreach($ghh as $keyb=>$valb){
						$cc = $this->getpanggilmenu($sett,$valb->id_item,($level+2),$na.".".$ne,$da."_".$valb->id_item,$set,$set_ref,$grup);
						$bb .= "<tr class=\"gridrow ".$seling."\" height=20>";
						$bb .= "<td class=\"gridcell left\" align=\"left\"><b><div id=\"nomer_".$valb->id_item."\">".$na.".".$ne."</div></b></td>";
						$jk = json_decode($valb->meta_value);
						if(empty($cc)){
								$cek2 = $this->m_menu->cekmenupengguna($valb->id_item,$set,$set_ref,$grup);
								if(empty($cek2)){
										$bb .= "<td class=\"gridcell\"><input type=checkbox id='ccshdk_".$val->id_item."' name='menu_path' value='".$da."_".$valb->id_item."'></td>";
								} else {
										$bb .= "<td class=\"gridcell\">&nbsp;</td>";
								}
								$bb .= "<td class=\"gridcell\" style=\"padding-left: ".($spare+20)."px;\"><div class=\"ui-icon ui-icon-document-b tree-leaf treeclick\" style=\"float: left;\"></div>".$valb->nama_item."</td>";
						} else {
								$bb .= "<td class=\"gridcell\">&nbsp;</td>";
								$bb .= "<td class=\"gridcell\" style=\"padding-left: ".($spare+20)."px;\"><div class=\"ui-icon treeclick ui-icon-triangle-1-s tree-minus\" style=\"float: left;\"></div>".$valb->nama_item."</td>";
						}
						$bb .= "<td class=\"gridcell\">".$jk->keterangan."</td>";
						$bb .= "</tr>";
						$bb = $bb.$cc;
						$ne++;
					}
				}
			$no++;
			}
		return $bb;
		}
	}
	function formhapus_menu_pengguna(){
		$data['idd']=end(explode("_",$_POST['idd']));
		$data['idparent']=$_POST['idparent'];
		$data['group_id']=$_POST['group_id'];
		$data['id_setting']=$_POST['id_setting'];

		if($_POST['level']==1){
			$data['level']=0;
			$data['rowparent']="";
			$data['parent']=0;
		} else {
			$idp=explode("_",$_POST['idd']);
			$isi	= $this->m_menu->getmenupengguna($_POST['id_setting'],$_POST['id_setting_ref'],$_POST['idparent'],$_POST['group_id']);

			$data['rowparent']="";
			$data['parent']="";
			if(count($isi)==1){
				$data['level']=$_POST['level']-2;
				for($i=0;$i<count($idp)-2;$i++){	$data['rowparent'].=$idp[$i]."_";	$data['parent'].=($i==0)?$idp[$i]:"_".$idp[$i];	}
			} else {
				$data['level']=$_POST['level']-1;
				for($i=0;$i<count($idp)-1;$i++){	$data['rowparent'].=$idp[$i]."_";	$data['parent'].=($i==0)?$idp[$i]:"_".$idp[$i];	}
			}
			if($data['parent']==""){$data['parent']=0;}
		}

		$hslquery= $this->m_menu->ini_item($data['idd']); 
			$jj = json_decode($hslquery[0]->meta_value);
		@$data['hslquery'][0]->menu_name=$hslquery[0]->nama_item;
		$data['hslquery'][0]->menu_path=$jj->path_menu;
		$data['hslquery'][0]->icon_menu=$jj->icon_menu;
		$data['hslquery'][0]->keterangan=$jj->keterangan;

		$this->load->view('menu/formhapus_menu_pengguna',$data);
	}
	function hapus_menu_pengguna_aksi(){
		$grup=$_POST['group_id'];
		$idm=$_POST['idmp'];
		$sqlstr="DELETE FROM cmf_setting WHERE id_setting='14' AND meta_value LIKE '%\"group_id\":\"".$grup."\"%' AND meta_value LIKE '%\"id_menu\":\"".$idm."\"%'";
		$this->db->query($sqlstr);
	}
////////////////////////////////////////////////////////////////////
/////Memproses naik urutan menu
////////////////////////////////////////////////////////////////////
	function naik_aksi(){
		$id_ini=end(explode("_",$_POST['id_ini']));
		$id_lawan=end(explode("_",$_POST['id_lawan']));
		$urutan_ini=$_POST['urutan_ini'];
		$urutan_lawan=$_POST['urutan_lawan'];
		$this->m_menu->naik_index($id_ini,$id_lawan,$urutan_ini,$urutan_lawan);
	}
}
?>