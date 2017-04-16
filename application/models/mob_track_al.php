<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_track_al extends CI_Model {

	public function get_location()
	{
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		$this->db->select('*')
		->from('alumni')
		->where('id_sklh',$id_sklh);
		return $this->db->get();
	}


	function get_all()
	{
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		$this->db->select('kota_al, count(kota_al) AS jmlh')
		->from('alumni')
		->where('id_sklh', $id_sklh)
		->group_by('kota_al')
		->order_by('kota_al', 'asc'); 
		return $this->db->get();
	}

	function count_get_all()
	{
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		$this->db->select('kota_al');
		return $this->db->get_where('alumni', array('id_sklh' => $id_sklh));

	}

	function count_get_all_kerja()
	{
		$id_sklh=$this->session->userdata('login')['id_sklh'];
		$this->db->select('kota_al');
		$this->db->where('alker_al !=', '');
		return $this->db->get_where('alumni', array('id_sklh' => $id_sklh));

	}

	function jumlah_kerja()
	{
		$this->db->select('kota_al, count(alker_al) AS kerja')
		->from('alumni')
		->where('alker_al !=','')
		->group_by('kota_al')
		->order_by('kota_al', 'asc'); 
		return $this->db->get();
	}


}

/* End of file mob_track_al.php */
/* Location: ./application/models/mob_track_al.php */