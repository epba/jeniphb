<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alumni extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login_alumni'))) {
			redirect('web_login/form/al','refresh');
		}
		$this->id_sklh = $this->session->userdata('data_login_alumni')['id_sklh'];
	}

	public function get_asal_sekolah()
	{
		return $this->db->get_where("sekolah",array('id_Sklh' => $this->session->userdata('data_login_alumni')['id_sklh']))->row();
	}

	public function get_sesama_alumni($params = array())
	{
		$this->db->select('*');
		$this->db->from('alumni');
        //filter data by searched keywords
		if(!empty($params['search']['keywords'])){
			$this->db->like('nama_al',$params['search']['keywords']);
		}
        //sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by('nama_al',$params['search']['sortBy']);
		}else{
			$this->db->order_by('nama_al','asc');
		}
        //set start and limit
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}
        //get records
		$query = $this->db->get();
        //return fetched data
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}

	public function get_loker($limit = "")
	{
		$this->db->order_by('time_lok', 'ASC');
		$this->db->where('verifikasi_lok', 1);
		$this->db->where('verifikasi_by_lok', $this->session->userdata('data_login_alumni')['id_sklh']);
		$this->db->or_where('verifikasi_by_lok', 'ADM1');
		$this->db->order_by('time_end_lok', 'ASC');
		$this->db->limit($limit);
		return $this->db->get('loker')->result();
	}

	public function get_detail_loker($id_lok,$id_sender)
	{
		preg_match("/ADM|PER/", $id_sender, $sender);
		if ($sender[0] == "PER") {
			$this->db->from("loker");
			$this->db->join("perusahaan", "loker.id_pengirim_lok = perusahaan.id_per");
			$this->db->where('id_per', $id_sender);
			$data = $this->db->get()->row();
			return $data;
		}
		elseif ($sender[0] == "ADM") {
			$this->db->where('id_lok', $id_lok);
			$data = $this->db->get("loker")->row();
			return $data;
		}
	}

	public function update_pass($data)
	{
		$this->db->where('id_al', $this->session->userdata('data_login_alumni')['id_al']);
		$data_alumni = $this->db->get('alumni')->row();
		if(password_verify($data['password_al'],$data_alumni->password_al))
		{
			$this->db->where('id_al', $this->session->userdata('data_login_alumni')['id_al']);
			$this->db->update('alumni', array('password_al' => password_hash($data['password_baru'],PASSWORD_BCRYPT)));
			return true;
		}
	}

	public function get_latlng_loker($id)
	{
		$this->db->select('lat_lok,lng_lok');
		return $this->db->get_where("loker",array('id_lok' => $id))->row();
	}

	public function get_profil_alumni()
	{
		$this->db->where('id_al', $this->session->userdata('data_login_alumni')['id_al']);
		return $this->db->get('alumni')->row();
	}

	public function proses_update_profil($data)
	{
		$this->db->where('id_al', $this->session->userdata('data_login_alumni')['id_al']);
		if($this->db->update('alumni',$data))
		{
			return true;
		}
	}
	public function get_location()
	{
		$id_sklh=$this->session->userdata('data_login_alumni')['id_sklh'];
		$this->db->select('*')
		->from('alumni')
		->where('id_sklh',$id_sklh);
		return $this->db->get();
	}


	function get_all()
	{
		$id_sklh=$this->session->userdata('data_login_alumni')['id_sklh'];
		$this->db->select('kota_al, count(kota_al) AS jmlh')
		->from('alumni')
		->where('id_sklh', $id_sklh)
		->where('kota_al !=',"")
		->group_by('kota_al')
		->order_by('kota_al', 'asc'); 
		return $this->db->get();
	}

	function count_get_all()
	{
		$id_sklh=$this->session->userdata('data_login_alumni')['id_sklh'];
		$this->db->select('kota_al');
		$this->db->where('kota_al !=',"");
		return $this->db->get_where('alumni', array('id_sklh' => $id_sklh));

	}

	function count_get_all_kerja()
	{
		$id_sklh=$this->session->userdata('data_login_alumni')['id_sklh'];
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

/* End of file m_alumni.php */
/* Location: ./application/models/m_alumni.php */