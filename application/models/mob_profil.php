<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_profil extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->id 		= $this->session->userdata('login')['id_al'];
		$this->id_sklh 	= $this->session->userdata('login')['id_sklh'];
		$this->uri3		= $this->uri->segment(3);
		$this->uri4		= $this->uri->segment(4);

	}

	
	public function checkOldPass($old_password)
	{
		$id=$this->session->userdata('login')['id_al'];
		$this->db->where('id_al', $id);
		$this->db->where('password_al', $old_password);
		$query = $this->db->get('alumni');
		if($query->num_rows() > 0)
			return 1;
		else
			return 0;
	}

	public function saveNewPass($new_pass)
	{
		$id=$this->session->userdata('login')['id_al'];
		$data = array(
			'password_al' => $new_pass
			);
		$this->db->where('id_al', $id);
		$this->db->update('alumni', $data);
		return true;
	}

	function my_profil()
	{
		return $this->db->get_where('alumni', array('id_al' => $this->id))->row();
	}



}



?>