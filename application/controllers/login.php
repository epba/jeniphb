<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('al_login_mobile');
		
	}
	
	public function index()
	{

		$web['title']   = 'Login Form';
		$this->load->view('mobile/template');
		$this->load->view('mobile/header_login');
		$this->load->view('mobile/login_alumni',$web);
		$this->load->view('mobile/footer');
	}

	public function proses(){
		$username = $this->input->post('username', 'true');
		$password = $this->input->post('password', 'true');
		$temp_account = $this->al_login_mobile->check_user_account($username, $password);
		if($temp_account){
			$this->session->set_flashdata("k", "<div class=\"sukses\">Login Sukses </div> ");
			redirect(base_url('mob_tampil'));
		}
		else {
			$this->session->set_flashdata("k", "<div class=\"error\">invalid username or password </div> ");
			redirect(base_url('login'));
		}
	}


	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

}
