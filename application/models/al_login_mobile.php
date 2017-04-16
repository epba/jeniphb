<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Al_login_mobile extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

// cek keberadaan user di sistem
	function check_user_account($username, $password){
		$this->db->select('*');
		$this->db->from('alumni');
		$this->db->where('username_al', $username);
		$data = $this->db->get()->result();
		$num_account = count($data);
		if ($num_account === 1){
			foreach ($data as $key => $value) {
				if(password_verify($password,$value->password_al))
				{
					$array_items = array(
						'id_al' => $value->id_al,
						'id_sklh' => $value->id_sklh,
						'username_al' => $value->username_al,
						'nama_al' => $value->nama_al,
						'logged_in' => true);
			 $this->session->sess_expiration = '32140800'; //~ one year
			 $this->session->sess_expire_on_close = 'false';
			 $this->session->set_userdata('login',$array_items);
			 return true;
			}
		}
	}
}
}

/* End of file al_login_mobile.php */
/* Location: ./application/models/al_login_mobile.php */