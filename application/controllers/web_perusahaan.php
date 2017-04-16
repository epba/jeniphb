<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_perusahaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login_perusahaan'))) {
			redirect('web_login/form/per','refresh');
		}
		$this->load->model('M_perusahaan');
	}


	public function template_persusahaan($data)
	{
		$kumpulan_data	=	array_merge(array("menu" => "perusahaan/menu","logout" => "web_logout/perusahaan"),$data);
		$this->load->view('template_adm_per', $kumpulan_data);
	}

	public function beranda()
	{
		$data['title']		= "Beranda";
		$data['halaman']	= "perusahaan/halaman_beranda";
		$this->template_persusahaan($data);
	}

	public function profil()
	{
		$data['title']		= "Profil";
		$data['halaman']	= "perusahaan/halaman_profil";
		$data['perusahaan']		= $this->M_perusahaan->get_profil();
		$this->template_persusahaan($data);
	}

	public function form_ganti_password()
	{
		if ($this->uri->segment(3) == "proses_ganti_password") {
			$config_rules = array(
				array(
					'field' => 'pass_lama',
					'label' => 'Password lama',
					'rules' => 'required'
					),
				array(
					'field' => 'pass_baru',
					'label' => 'Password',
					'rules' => 'required|min_length[6]'
					),
				array(
					'field' => 'pass_konfir',
					'label' => 'Possword Konfirmasi',
					'rules' => 'required|matches[pass_baru]'
					)
				);
			$this->form_validation->set_rules($config_rules);
			if($this->form_validation->run()) 
			{
				$data['password_per']	=	$this->input->post('pass_lama');
				$data['password_baru']	=	$this->input->post('pass_baru');
				if($this->M_perusahaan->update_pass($data)){
					$this->session->set_flashdata('notifikasi', $this->notif->sukses_edit());
					redirect('Web_perusahaan/form_ganti_password','refresh');
				}
				else{
					$this->session->set_flashdata('notifikasi', $this->notif->fail_update_password());
					redirect('Web_perusahaan/form_ganti_password','refresh');
				}

			}
			else
			{
				$error = validation_errors();
				$this->session->set_flashdata('notifikasi', $this->notif->validasi_update_password($error));
				redirect('Web_perusahaan/form_ganti_password','refresh');
			}
		}
		else {
			$data['title']		= "Ganti Password";
			$data['halaman']	= "perusahaan/form_ganti_password";
			$this->template_persusahaan($data);
		}
	}

	public function data_loker()
	{
		$data['title']		= "Data Loker";
		$data['halaman']	= "perusahaan/halaman_data_loker";
		$data['loker']		= $this->M_perusahaan->get_data_loker();
		$this->template_persusahaan($data);
	}

	public function form_loker()
	{
		$this->load->library('googlemaps');
		$marker = array();
		$marker['center'] = 'auto';
		$marker['onboundschanged'] = 'if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;';
		$this->googlemaps->initialize($marker);

		$marker = array();
		$marker['position'] = 'auto';
		$marker['draggable'] = true;
		$marker['ondragstart'] = '
		$("#lat_lok").val("");
		$("#lng_lok").val("");
		$("#kota_lok").val("");';
		$marker['ondragend'] = '			
		$("#lat_lok").val( event.latLng.lat()).change();
		$("#lng_lok").val( event.latLng.lng()).change();';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		if ($this->uri->segment(3) == "add") {
			$data['title']		= "Tambah Data Loker";
			$data['halaman']	= "perusahaan/form_loker";
		}
		elseif ($this->uri->segment(3) == "edit") {
			$data['title']		= "Edit Data Loker";
			$data['halaman']	= "perusahaan/form_loker";
			$data['data_lama']	= $this->M_perusahaan->data_lama_loker($this->uri->segment(4));
		}
		$this->template_persusahaan($data);
	}

	public function tampung_data_loker()
	{
		$func_model		= ($this->uri->segment(3) == "add") ? "proses_tambah_loker" : "proses_edit_loker" ;
		$notif_sukses	= ($this->uri->segment(3) == "add") ? "sukses_add" : "sukses_edit";

		$this->form_validation->set_rules('judul_lok','Judul Loker','required|min_length[10]');
		$this->form_validation->set_rules('isi_lok','Konten Loker','required|min_length[30]');
		$this->form_validation->set_rules('alamat_lok','Isikan Alamat Loker','required|min_length[10]');
		$this->form_validation->set_rules('time_end_lok','Masa Berlaku','required');
		if($this->form_validation->run())     
		{   
			$data_loker = array(
				'id_pengirim_lok'	=> $this->session->userdata('data_login_perusahaan')['id_per'],
				'tmp_lok'			=> $this->session->userdata('data_login_perusahaan')['nama_per'],
				'judul_lok' 		=> addslashes($this->input->post('judul_lok')),
				'isi_lok'			=> addslashes($this->input->post('isi_lok')),
				'lng_lok'			=> addslashes($this->input->post('lng_lok')),
				'lat_lok'			=> addslashes($this->input->post('lat_lok')),
				'kota_lok' 			=> addslashes($this->input->post('kota_lok')),
				'alamat_lok' 		=> addslashes($this->input->post('alamat_lok')),
				'time_lok' 			=> date("Y-m-d"),
				'time_end_lok' 		=> date("Y-m-d"),
				'verifikasi_by_lok'	=> $this->session->userdata('data_login_perusahaan')['add_by'],
				'verifikasi_lok' 	=> "0"
				);
			// form mengandung foto
			if (!empty($_FILES['foto_lok']['name'])) 
			{
				preg_match("/png|jpg|jpeg/", $_FILES['foto_lok']['name'],$extensi);
				$config['upload_path'] 	 = './assets/upload/loker';
				$config['allowed_types'] = 'jpg|png|jpeg';	
				$config['file_name'] 	 = $data_loker['id_pengirim_lok']."_".date("ymdwhis").".".$extensi[0];

				$this->upload->initialize($config);
				$kirim_data = $this->M_perusahaan->$func_model(array_merge($data_loker,array('foto_lok' => $config['file_name'])));
				if ($kirim_data) {
					$this->load->library('upload', $config);
						//jika gagal upload
					if ( ! $this->upload->do_upload("foto_lok"))
					{
						$error_upload = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('notifikasi', $this->notif->sukses_tanpa_foto($error_upload));
						redirect('Web_perusahaan/data_loker','refresh');
					}
					//jika sukses upload
					else
					{ 
						$this->session->set_flashdata('notifikasi', $this->notif->$notif_sukses());
						redirect('Web_perusahaan/data_loker','refresh');
					}
				}
				else {
					$this->session->set_flashdata('notifikasi', $this->notif->fail());
					redirect('Web_perusahaan/data_loker','refresh');
				}
			}
			// form tdk mengandung foto
			else { 
				$kirim_data = $this->M_perusahaan->$func_model($data_loker);
				if ($kirim_data) {
					$this->session->set_flashdata('notifikasi', $this->notif->$notif_sukses());
					redirect('Web_perusahaan/data_loker','refresh');
				}
				else
				{
					$this->session->set_flashdata('notifikasi', $this->notif->fail());
					redirect('Web_perusahaan/data_loker','refresh');
				}
			}
		}
		else
		{
			$error = validation_errors();
			$this->session->set_flashdata('notifikasi', $this->notif->validasi($error));
			redirect('Web_perusahaan/form_loker/add','refresh');
		}
	}

	public function data_detail_loker($id)
	{
		$data['loker']		= $this->M_perusahaan->get_detail_loker($id);
		if ($data['loker'] == null) {
			echo "null";
		}
		else
		{
			$data['title']		= "Detail Loker";
			$data['halaman']	= "perusahaan/halaman_detail_loker";
			$this->template_persusahaan($data);
		}
	}

	public function get_lokasi($lat, $lng){ 
		$latlng = $lat . ',' . $lng;
		$request_url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latlng.'&sensor=false';
		$Data = json_decode(file_get_contents($request_url));
		$this->load->library('googlemaps');
		$this->load->library('Lbs');
		$get = $this->lbs->getAddress($lat, $lng);
		if(!isset($get['response']['city']) or $get['response']['city'] == null){
			echo "Unknown";
		}
		else{
			echo $get['response']['city'];
		}
	}

	public function hapus_loker()
	{
		$id_loker 	= $this->uri->segment(3);
		$foto_loker = $this->uri->segment(4);
		if($this->M_perusahaan->proses_hapus_loker($id_loker,$foto_loker)){
			$this->session->set_flashdata('notifikasi', $this->notif->sukses_hapus());
			redirect('Web_perusahaan/data_loker','refresh');
		}
		else {
			$this->session->set_flashdata('notifikasi', $this->notif->fail_hapus());
			redirect('Web_perusahaan/data_loker','refresh');
		}
	}
}


/* End of file institusi.php */
/* Location: ./application/controllers/institusi.php */