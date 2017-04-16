<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login_admin'))) {
			redirect('web_login/form/adm','refresh');
		}
	}

	public function get_data_admin()
	{
		return $this->db->get('admin')->result();
	}

	public function update_pass($data)
	{
		$this->db->where('id_adm', $this->session->userdata('data_login_admin')['id_adm']);
		$data_admin = $this->db->get('admin')->row();
		if(password_verify($data['password_adm'],$data_admin->password_adm))
		{
			$this->db->where('id_adm', $this->session->userdata('data_login_admin')['id_adm']);
			$this->db->update('admin', array('password_adm' => password_hash($data['password_baru'],PASSWORD_BCRYPT)));
			return true;
		}
	}

	public function get_perusahaan()
	{
		return $this->db->get_where("perusahaan")->result();
	}

	public function get_detail_perusahaan($id)
	{	
		$perusahaan = $this->db->get_where("perusahaan",array("id_per" => $id))->row();
		// var_dump($perusahaan);
		preg_match("/ADM|SKL/", $perusahaan->add_by, $per);
		if ($per[0] == "SKL") {
			$this->db->from("perusahaan");
			$this->db->select("perusahaan.*,sekolah.nama_sklh");
			$this->db->join("sekolah", "sekolah.id_sklh = perusahaan.add_by");
			$this->db->where('id_per', $id);
			$data = $this->db->get()->row();
			return $data;
		}
		elseif ($per[0] == "ADM") {
			$this->db->select("perusahaan.*,admin.nama_adm");
			$this->db->from('perusahaan');
			$this->db->join('admin', 'admin.id_adm = perusahaan.add_by');
			$this->db->where('id_adm', $perusahaan->add_by);
			$data = $this->db->get()->row();
			return $data;
		}
	}

	public function get_detail_sekolah($id)
	{
		return $this->db->get_where("sekolah",array("id_sklh" => $id))->row();
	}

	public function get_detail_loker($id)
	{	
		return $this->db->get_where("loker",array("id_lok" => $id))->row();
	}

	public function get_sekolah()
	{
		return $this->db->get("sekolah")->result();
	}

	public function get_data_loker()
	{
		$this->db->select("loker.*,perusahaan.add_by");
		$this->db->from('loker');
		$this->db->join('perusahaan', 'loker.id_pengirim_lok = perusahaan.id_per',"left");
		$this->db->where('verifikasi_lok', "1");
		return $this->db->get()->result();
	}

	public function proses_acc_loker($id)
	{
		$this->db->where('id_lok', $id);
		$update	= $this->db->update('loker', array('verifikasi_lok' => "1", 'verifikasi_by_lok' => $this->session->userdata('data_login_admin')['id_adm']));
		if($update)
		{
			return true;
		}
	}

	public function proses_tambah_data($tabel,$data)
	{
		if ($this->db->insert($tabel, $data))
		{
			return TRUE;
		}
		else {
			return false;
		}
	}

	public function proses_hapus($id,$tabel)// SEKOLAH DAN PERUSAHAAN
	{
		$img			= $this->uri->segment(5);
		$id_tabel     	= ($tabel == "sekolah") ? "id_sklh" : "id_per";
		switch ($tabel) {
			case 'perusahaan':
			//hps foto loker
			$this->db->select('foto_lok');
			$loker	= $this->db->get_where("loker",array("id_pengirim_lok" => $id))->result();
			foreach ($loker as $key) {
				@unlink("assets/upload/loker/".$key->foto_lok);
			}
			//hapus loker
			$this->db->where($id_tabel, $id);
			$delete = $this->db->delete($tabel);
			if ($delete) {
				if(file_exists("assets/upload/".$tabel."/".$img)){
					@unlink("assets/upload/".$tabel."/".$img);
				}
				return true;
			}
			break;

			case 'sekolah':
			//hps foto alumni
			$this->db->select('foto_al');
			$alumni	= $this->db->get_where("alumni",array("id_sklh" => $id))->result();
			foreach ($alumni as $key) {
				@unlink("assets/upload/alumni/".$key->foto_al);
			}
			//hapus foto perusahaan dan foto loker
			$this->db->select('foto_lok,logo_per');
			$this->db->from('loker');
			$this->db->join('perusahaan', 'perusahaan.id_per = loker.id_pengirim_lok');
			$this->db->where('add_by', $id);
			$hsl	= $this->db->get()->result();
			foreach ($hsl as $key) {
				@unlink("assets/upload/perusahaan/".$key->logo_per);
				@unlink("assets/upload/loker/".$key->foto_lok);
			}

			//hapus alumni
			$this->db->where($id_tabel, $id);
			$delete = $this->db->delete($tabel);
			if ($delete) {
				if(file_exists("assets/upload/".$tabel."/".$img)){
					@unlink("assets/upload/".$tabel."/".$img);
				}
				return true;
			}

			break;

			default:
					# code...
			break;
		}
	}

	public function proses_hapus_loker($id,$img)
	{
		$this->db->where('id_lok', $id);
		$hps = $this->db->delete('loker');
		if ($hps) {
			if(file_exists("assets/upload/loker"."/".$img)){
				@unlink("assets/upload/loker"."/".$img);
			}
			return true;
		}
	}

	public function get_max_id_user($tabel)
	{
		$str_id        	= ($tabel == "sekolah") ? "SKL" : "PER";
		$id_tabel     	= ($tabel == "sekolah") ? "id_sklh" : "id_per";
		$this->db->select("MAX(CONVERT(SUBSTRING_INDEX($id_tabel,'$str_id', -1),INT))+1 as 'num_max'");      
		$get_num 		= $this->db->get($tabel)->row();
		$num_max_id		= ($get_num->num_max == null) ? "1" :  $get_num->num_max;  

		return $str_id.$num_max_id;
	}
}

/* End of file m_admin.php */
/* Location: ./application/models/m_admin.php */