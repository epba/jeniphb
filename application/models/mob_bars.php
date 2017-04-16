<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_bars extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->id 		= $this->session->userdata('login')['id_al'];
		$this->id_sklh 	= $this->session->userdata('login')['id_sklh'];
		$this->uri3		= $this->uri->segment(3);
		$this->uri4		= $this->uri->segment(4);

	}


	function sekolah() 
	{
		$this->db->select('*');    
		$this->db->from('alumni');
		$this->db->join('sekolah', 'alumni.id_sklh = sekolah.id_sklh');
		$this->db->where('id_al', $this->id );
		return $this->db->get()->row();
	}	

}

?>