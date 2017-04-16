<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_loker extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->id 		= $this->session->userdata('login')['id_al'];
		$this->id_sklh 	= $this->session->userdata('login')['id_sklh'];
		$this->tgl      = date('Y-m-d');
		$this->uri4 		= $this->uri->segment(4);
	}
	function loker($sampai,$dari)
	{
		$this->db->order_by('time_lok', 'ASC');
		$this->db->limit($sampai,$dari);	
		

		/*	$this->db->where('`id_pengirim_lok` in', '(select `locationId` from `locations` where `countryId` = '.$countryId.')', false);*/

		return $this->db->get_where('loker', array('verifikasi_lok' => 1, 'time_end_lok >=' => $this->tgl, 'verifikasi_by_lok' => $this->id_sklh ))->result(); 
	}





	function jumlah(){

		return $this->db->get_where('loker', array('verifikasi_lok' => 1, 'time_end_lok >=' => $this->tgl, 'verifikasi_by_lok' => $this->id_sklh ))->num_rows();
	}


	function loker_me($sampai,$dari)
	{
		$this->db->order_by('time_lok', 'ASC');
		$this->db->limit($sampai,$dari);		
		return $this->db->get_where('loker', array('id_pengirim_lok' => $this->id ))->result(); 
		
	}

	function jumlah_me(){
		return $this->db->get_where('loker', array('id_pengirim_lok' => $this->id ))->num_rows();
	}

	function view(){
		return $this->db->get_where('loker', array('id_lok' => $this->uri4))->row(); 
	}
	
	function track(){
		return $this->db->get_where('loker', array('id_lok' => $this->uri4))->row(); 
	}
}
?>