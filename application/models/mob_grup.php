<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_grup  extends CI_Model {


	function member()
	{
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		return $sql = $this->db->get_where('alumni', array('id_sklh' => $id_sklh))->result();
		
	}

	function agenda()
	{
		$now = date('l, jS  F Y ');
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		return $sql = $this->db->get_where('agenda', array('post_by_ag' => $id_sklh, 'time_ag <=' => $now))->result(); 
		
	}

	

}

/* End of file mob_grup */
/* Location: ./application/models/mob_grup */
?>