<?php
class Login extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_web');
	}
/////////////////////////////////////////////////////////
	public function index(){
		$session_data = $this->session->userdata('logged_in');
		$data['sesi'] = $session_data['back_office'];
		
		if(!empty($data['sesi'])){ redirect($data['sesi']);	}

		$data['nama_app']=$this->m_web->getopsivalue('nama_app');
		$data['slogan_app']=$this->m_web->getopsivalue('slogan_app');
		$data['logo_app']=$this->m_web->getopsivalue('logo_app');
		$this->viewPath = '../../assets/themes/login/';
		$this->load->view($this->viewPath.'index',$data);
	}
/////////////////////////////////////////////////////////
	public function dologin(){
		$this->load->library('auth/auth');
		$this->form_validation->set_rules('ibuku_sayang',"Nama User",'trim|required|xss_clean');
		$this->form_validation->set_rules('sendok',"Password",'trim|required|xss_clean');
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];
		if($this->form_validation->run() == false || $user_name!="" || $user_password!=""){
			$responce = array('result'=>'failed','message'=>'Username dan Password harus diisi');
		} else {
			$this->load->library('auth');	
			$datalogin = array(
							'user_name'=>$this->input->post('ibuku_sayang'),
							'user_password'=>$this->input->post('sendok')
						);
			if($this->auth->process_login($datalogin)==FALSE){  
				$responce = array('result'=>'failed','message'=>'Username atau Password yang anda masukkan salah');
			} else {		
				$session_data = $this->session->userdata('logged_in');
				$responce = array('result'=>'succes','message'=>'Login anda diterima. Mohon menunggu..','section'=>$session_data['back_office']);
			}
		}
		echo json_encode($responce);
	}
/////////////////////////////////////////////////////////
	public function keepalive(){
		echo 'OK';
	}
/////////////////////////////////////////////////////////
	public function out(){
		$session_data = $this->session->userdata('logged_in');
		$this->db->delete('user_online',array('user_id'=>@$session_data['id_user']));
		$this->session->sess_destroy();
		echo "<script type=\"text/javascript\">location.href = '".site_url()."' + 'login'; </script>";
	}
/////////////////////////////////////////////////////////
}

