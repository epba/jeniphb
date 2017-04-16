<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_feeds extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->id 		= $this->session->userdata('login')['id_al'];
		$this->id_sklh 	= $this->session->userdata('login')['id_sklh'];
		$this->uri3		= $this->uri->segment(3);
		$this->uri4		= $this->uri->segment(4);

	}

	function all_feeds($sampai,$dari){
		$this->db->select('*');    
		$this->db->from('feed');
		$this->db->join('alumni', 'alumni.id_al = feed.id_al ');
		$where = "alumni.id_al = `feed.id_al` AND alumni.id_sklh = '$this->id_sklh'";
		$this->db->where($where);
		$this->db->order_by('time_feed', 'ASC');
		$this->db->limit($sampai,$dari);
		$query = $this->db->get();
		return $query->result();
	}

	function jumlah(){
		$query = $this->db->get('feed');
		return $query->num_rows();
	}

	function my_feeds(){
		$this->db->select('nama_al,foto_al,feed.isi_feed');    
		$this->db->from('alumni');
		$this->db->join('feed', 'alumni.id_al = feed.id_al');
		$this->db->where('alumni.id_al', $this->id );
		return $this->db->get()->row();
		

	}
}
?>
