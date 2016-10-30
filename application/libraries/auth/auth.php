<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	var $CI = null;

	function __construct() {
		date_default_timezone_set('Asia/Jakarta');

		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('auth/JSON','auth/simplival');
		$this->CI->load->library('session');

		@$kbase="8aHe3nUv9Wo4";
	}
/////////////////////////////khusus group_id = 7//////////////////////>>
    function get_user_pegawai($user_id = false)
    {
      $this->CI->db->select('b.id_pegawai');
      $this->CI->db->select('b.nama_pegawai');
      $this->CI->db->from('user_pegawai a');
      $this->CI->db->join('r_pegawai b','a.id_pegawai=b.id_pegawai');
      $this->CI->db->where('a.user_id',$user_id);
      $pegawai = $this->CI->db->get()->row();
      return $pegawai;
    }
/////////////////////////////khusus group_id = 7//////////////////////>>
    function get_user_pegmasuk($user_id = false)
    {
      $this->CI->db->select('b.id_pegawai');
      $this->CI->db->select('b.nama_pegawai');
      $this->CI->db->from('user_pegmasuk a');
      $this->CI->db->join('r_pegawai b','a.id_pegawai=b.id_pegawai');
      $this->CI->db->where('a.user_id',$user_id);
      $pegawai = $this->CI->db->get()->row();
      return $pegawai;
    }
/////////////////////////////////////////////////////////
	function checkIP(){
		$domain = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
		 ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$this->CI->db->from('allowed_ip');
		$this->CI->db->where('ip_address',$domain);
		$exist = $this->CI->db->count_all_results();
		if($exist == 0)
		{
			echo $this->warning($this->CI->config->item('project_name').' tidak memperbolehkan Login di Area Anda',site_url());
			die();
		}
	}
	function checkOnline($id){
		$this->CI->db->where('user_id',$id);
		$this->CI->db->from('user_online');
		return $this->CI->db->count_all_results();
	}
	function getLastActivity($id){
		$this->CI->db->select('last_activity');
		$this->CI->db->from('user_online');
		$this->CI->db->where('user_id',$id);
		$data = $this->CI->db->get();
		$row = $data->row();
		return $row->last_activity;
	}
	function getDiff($old,$now)	{
	    if($old == '' OR $now == ''){	
			return TRUE;	
		} elseif((strtotime($now)-strtotime($old))>=300){
			return TRUE;	
		} else {
			return FALSE;
		}
	}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
	function process_login($login = NULL){
	     	// A few safety checks
	    	// Our array has to be set
	    	// $this->checkIP();
	    	if(!isset($login)){	return FALSE;	}
	    	//Our array has to have 2 values
	     	//No more, no less!
	    	if(count($login) != 2){	return FALSE;	}

	     	$username = $login['user_name'];
	     	$password = sha1($login['user_password']);
			$sqlstr="SELECT a.*, b.* FROM users a LEFT JOIN (cmf_setting b) ON (a.group_id=b.id_item) WHERE a.username = '$username' AND a.passwd='$password'";
			$query=$this->CI->db->query($sqlstr);

			foreach ($query->result() as $row) {
				$id_user=$row->user_id;
				$username= $row->username;
				$nama_user = $row->nama_user;
				$id_group = $row->group_id;
				$group_name = $row->nama_item;
					$jj = json_decode($row->meta_value);

				$section_name = $jj->section_name;
				$back_office = $jj->back_office;

				$status_online = $this->checkOnline($id_user);
				if($status_online == 1){
					$now = date('Y-m-d H:i:s');
					$old = $this->getLastActivity($id_user);
					if(!$this->getDiff($old,$now)) {
						$responce = array('result'=>'failed','message'=>"Anda masih tercatat dalam database sebagai user online.<br>Ini mungkin terjadi karena :<br>1. Anda belum '<b>Logout</b>' pada waktu terakhir kali Anda login, atau <br>2. Ada orang lain yang sedang menggunakan user Anda. <br><br>Jika kemungkinan pertama memang benar, Anda hanya perlu menunggu sekitar 5 menit dari \nsejak aktivitas terakhir Anda di sistem. <br>Jika 5 menit berselang namun \nAnda masih tetap tidak bisa login, maka kemungkinan kedua bisa jadi benar. <br>Jika Anda tidak yakin, silakan hubungi Administrator untuk konfirmasi. \nHal ini penting untuk mengindari adanya pemakaian user oleh orang yang tidak bertanggung jawab.");
						echo json_encode($responce);
						die();
					} else {
						$this->CI->db->delete('user_online',array('user_id'=>$id_user));
					}
				}
        	}

	     	if ($query->num_rows() > 0) {
			//======================= VARIABEL SESSION WAJIB / STNDAR ==========================
				$sessm = array();
				$sessm['id_user'] = $id_user;
				$sessm['username']= $username;
				$sessm['nama_user']= $nama_user;
				$sessm['id_group'] = $id_group;
				$sessm['group_name'] = $group_name;
				$sessm['section_name'] = $section_name;
				$sessm['back_office'] = $back_office;
				$sessm['logged_in'] = TRUE;
			//===================== VARIABEL SESSION TAMBAHAN SPESIFIK PER SECTION =========================
			switch ($group_name):
				case 'pegawai':
                  	$pegawai = $this->get_user_pegawai($id_user);
					$this->CI->session->set_userdata('pegawai_info', $pegawai->id_pegawai);
					$this->CI->session->set_userdata('user_id', $id_user);
					$this->CI->session->set_userdata('group_id', $id_group);
					break;
				case 'pegmasuk':
                  	$pegawai = $this->get_user_pegmasuk($id_user);
					$this->CI->session->set_userdata('pegawai_info', $pegawai->id_pegawai);
					$this->CI->session->set_userdata('user_id', $id_user);
					$this->CI->session->set_userdata('group_id', $id_group);
					break;
				default:
				break;
			endswitch;
///////////////////////SET SESSION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			$this->CI->session->set_userdata('logged_in', $sessm);
///////////////////////SET SESSION<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
			$nnw = date('Y-m-d H:i:s');
			$this->CI->db->insert('user_online',array('user_id'=>$id_user,'last_activity'=>$nnw,'ip_address'=>$this->CI->input->ip_address()));
			return TRUE;
		} else {
		    // No existing user.
		    return FALSE;
		}
	}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/**
*
* This function restricts users from certain pages.
* use restrict(TRUE) if a user can't access a page when logged in
*
* @access	public
* @param	boolean	wether the page is viewable when logged in
* @return	void
*/
	function restrict($logged_out = FALSE) {
			// $this->checkIP();
			// If the user is logged in and he's trying to access a page
			// he's not allowed to see when logged in,
			// redirect him to the index!
			if ($logged_out && $this->logged_in()){
				  echo $this->warning('Maaf, sepertinya Anda sudah login...',site_url($_sessm['nama'] ));
				  die();
			}
			// If the user isn' logged in and he's trying to access a page
			// he's not allowed to see when logged out,
			// redirect him to the login page!
			if ( ! $logged_out && ! $this->logged_in()){
				  echo $this->warning('Anda diharuskan untuk Login bila ingin mengakses halaman Administrasi.',site_url('login'));
				  die();
			}
     }
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/**
 *
 * Checks if a user is logged in
 *
 * @access	public
 * @return	boolean
 */
   	function logged_in(){
		$session_data = $this->CI->session->userdata('logged_in');
      	if (@$session_data['id_user'] == FALSE){
	       	return FALSE;
		} else {
	         return TRUE;
		}
    }
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
    function logout(){
		$id_user=$_sessm['id_user'];
		$this->CI->db->delete('user_online',array('user_id'=>$id_user));
		// destroy the session
		$this->CI->session->sess_destroy();
		return TRUE;
    }


function warning($input,$goTo=''){
	if($goTo==''){
	   // $goTo = site_url().'/admin';
	   $goTo = site_url().'/';
	}
	$output="<script> 
                alert(\"$input\");
                location = '$goTo';
            </script>";
	return $output;
	}

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
}
// End of library class
// Location: system/application/libraries/Auth.php