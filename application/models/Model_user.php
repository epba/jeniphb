<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->id 		= $this->session->userdata('login')['id_al'];

	}
	function getAll($where="")
	{
		if($where) $this->db->where($where);
		return $this->db->get("alumni");
	}


	function getAll_chat($where="")
	{
		if($where) $this->db->where($where);

		/*		data terakhir*/		

		$this->db->select('message');
		$this->db->where('send_to', $this->id);
		$this->db->group_by('send_by');

		$this->db->order_by('chat_id', 'desc');
		

		$a = $this->db->get("chat")->result();
		$hasil = $a[0]->message;



		$this->db->select('message,time');
		$this->db->where('message', $hasil);

		$this->db->order_by('chat_id', 'desc');
		$this->db->group_by('send_by');

		return $this->db->get("chat");
	}

}
