<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_alumni extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login_alumni'))) {
			redirect('web_login/form/al','refresh');
		}
		$this->load->model('M_alumni');
	}
	public function template_alumni($data)
	{
		$kumpulan_data	=	array_merge(array("menu" => "alumni/menu","logout" => "web_logout/alumni"),$data);
		$this->load->view('template_alumni', $kumpulan_data);
	}

	public function edit_password()
	{
		if ($this->uri->segment(3) == "form") {
			$data['title']			= "Edit Password";
			$data['halaman']		= "alumni/form_edit_password";
			$this->template_alumni($data);
		}
		elseif ($this->uri->segment(3) == "proses") {
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
				$data['password_al']	=	$this->input->post('pass_lama');
				$data['password_baru']	=	$this->input->post('pass_baru');
				if($this->M_alumni->update_pass($data)){
					$this->session->set_flashdata('notifikasi', $this->notif->sukses_edit());
					redirect('web_alumni/edit_password/form','refresh');
				}
				else{
					$this->session->set_flashdata('notifikasi', $this->notif->fail_update_password());
					redirect('web_alumni/edit_password/form','refresh');
				}

			}
			else
			{
				$error = validation_errors();
				$this->session->set_flashdata('notifikasi', $this->notif->validasi_update_password($error));
				redirect('web_alumni/edit_password/form','refresh');
			}
		}
		else {
			$data['title']		= "Ganti Password";
			$data['halaman']	= "admin/ganti_password/form";
			$this->template_admin($data);
		}
	}

	public function beranda()
	{
		$data['title']			= "Beranda";
		$data['halaman']		= "alumni/halaman_beranda";
		$this->template_alumni($data);

	}

	public function agenda()
	{
		$data['title']			= "Agenda";
		$data['halaman']		= "alumni/halaman_agenda";
		$this->template_alumni($data);
	}

	public function gis()
	{
		$data['title']			= "GIS Alumni";
		$data['halaman']		= "alumni/halaman_gis";
		$data['title'] = 'GIS Alumni';
		$this->load->library('googlemaps');
		$temp_result = $this->M_alumni->get_location()->result();
		$marker = array();
		foreach ($temp_result as $value) {
			$marker['position'] = $value->kota_al;
			$marker['infowindow_content'] = $value->kota_al;
			$marker['center'] = 'indonesia';
			$marker['zoom'] = 5 ;
			$this->googlemaps->add_marker($marker);	
		}

		$this->googlemaps->initialize($marker);
		$data['map'] = $this->googlemaps->create_map();
		$data['kota'] = $this->M_alumni->get_all()->result();
		$data['jmlh'] = $this->M_alumni->jumlah_kerja()->result();
		$data['jm_kota'] = $this->M_alumni->count_get_all_kerja()->num_rows();
		$data['jm_jmlh'] = $this->M_alumni->count_get_all()->num_rows();
		$this->template_alumni($data);
	}

	public function sesama_alumni()
	{
		$data['title']			= "Sesama Alumni";
		$data['halaman']		= "alumni/halaman_sesama_alumni";
		$data['asal_sekolah']	= $this->M_alumni->get_asal_sekolah();
		        //pagination configuration
		$this->perPage = 6;
		$totalRec = count($this->M_alumni->get_Sesama_alumni());
		$config['target']      = '#sesama_alumni';
		$config['base_url']    = base_url().'web_alumni/ajax_pagination_alumni';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->load->library('ajax_pagination');
		$this->ajax_pagination->initialize($config);

        //get the posts data
		$data['alumni'] = $this->M_alumni->get_Sesama_alumni(array('limit'=>$this->perPage));
		$this->template_alumni($data);
	}

	function ajax_pagination_alumni(){
		$this->perPage = 6;
		$conditions = array();

        //calc offset number
		$page = $this->input->post('page');
		if(!$page){
			$offset = 0;
		}else{
			$offset = $page;
		}

        //set conditions for search
		$keywords = $this->input->post('keywords');
		$sortBy = $this->input->post('sortBy');
		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy'] = $sortBy;
		}

        //total rows count
		$totalRec = count($this->M_alumni->get_Sesama_alumni($conditions));

        //pagination configuration
		$config['target']      = '#sesama_alumni';
		$config['base_url']    = base_url().'web_alumni/ajax_pagination_alumni';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->load->library('ajax_pagination');
		$this->ajax_pagination->initialize($config);

        //set start and limit
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

        //get posts data
		$data['alumni'] = $this->M_alumni->get_Sesama_alumni($conditions);

        //load the view
		$this->load->view('alumni/data_sesama_alumni', $data, false);
	}

	public function loker()
	{
		$data['title']			= "Lowongan Kerja";
		$data['halaman']		= "alumni/halaman_loker";
		$data['loker']	= $this->M_alumni->get_loker();
		$this->template_alumni($data);
	}

	public function detail_loker($id_lok,$id_sender)
	{
		if (empty($id_lok) || empty($id_sender)) {
			redirect('web_alumni/not_found','refresh');
		}
		else{
			$data['title']			= "Detail Loker";
			$data['halaman']		= "alumni/halaman_detail_loker";
			$data['loker']			= $this->M_alumni->get_detail_loker($id_lok,$id_sender);
			$data['loker_lainya']	= $this->M_alumni->get_loker(4);
			$this->load->library('googlemaps');
			if ($this->uri->segment(5) == "track") {
				$config = array();
				$config['zoom']		 = '10';
				$config['center'] = 'auto';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
				}
				centreGot = true;';
				$config['directions'] = TRUE;
				$config['directionsStart'] = 'auto';
				$config['directionsEnd'] = ''.$data['loker']->lat_lok.', '.$data['loker']->lng_lok.'';
				$config['directionsDivID'] = 'directionsDiv';
				$config['directionsDraggable'] = 'true';
				$this->googlemaps->initialize($config);
			}

			$url = ($this->uri->segment(5) != "track") ? "<b>".$data['loker']->tmp_lok."</b><p><a href=".base_url()."web_alumni/detail_loker/".$id_lok."/".$id_sender."/track>Track</p>":"<b>".$data['loker']->tmp_lok."</b>";
			$marker = array();
			$this->googlemaps->add_marker($marker);
			$latlng					= $this->M_alumni->get_latlng_loker($id_lok,$id_sender);
			$marker 				= array();
			$marker['position'] 	= $latlng->lat_lok.",".$latlng->lng_lok;
			$content 				= $url;
			$marker['infowindow_content'] = $content;
			$this->googlemaps->add_marker($marker);

			$data['map']		 = $this->googlemaps->create_map();
			$this->template_alumni($data);
		}
	}

	public function profil()
	{
		$data['title']			= "Profil";
		$data['halaman']		= "alumni/halaman_profil";
		$data['profil']			= $this->M_alumni->get_profil_alumni();
		$data['asal_sekolah']	= $this->M_alumni->get_asal_sekolah();

		if (!empty($data['profil']->lat_al)) {
			$this->load->library('googlemaps');

			$config['center'] = $data['profil']->lat_al.', '.$data['profil']->lng_al;
			$config['zoom'] = '14';
			$this->googlemaps->initialize($config);

			$marker = array();
			$marker['position'] = $data['profil']->lat_al.', '.$data['profil']->lng_al;
			$marker['infowindow_content'] = "Lokasi rumah Kamu, benar ? kalau bukan, update datanya ya";
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();

		}
		$this->template_alumni($data);
	}

	public function update_profil($id)
	{
		if ($id != $this->session->userdata('data_login_alumni')['id_al']) {
			redirect('web_alumni/not_found','refresh');
		}
		else {
			$config_rules = array(
				array(
					'field' => 'lat_al',
					'label' => 'Latitude',
					'rules' => 'required'
					),
				array(
					'field' => 'lng_al',
					'label' => 'Longitude',
					'rules' => 'required'
					),
				array(
					'field' => 'kota_al',
					'label' => 'Kota',
					'rules' => 'required'
					),
				array(
					'field' => 'alamat_al',
					'label' => 'Alamat lengkap',
					'rules' => 'required'
					)
				);
			$this->form_validation->set_rules($config_rules);
			if($this->form_validation->run()) 
			{
				$data['email_al']	= addslashes($this->input->post('email_al'));
				$data['cp_al'] 		= addslashes($this->input->post('cp_al'));
				$data['lat_al'] 	= addslashes($this->input->post('lat_al'));
				$data['lng_al'] 	= addslashes($this->input->post('lng_al'));
				$data['alker_al'] 	= addslashes($this->input->post('alker_al'));
				$data['kota_al'] 	= addslashes($this->input->post('kota_al'));
				$data['alamat_al'] 	= addslashes($this->input->post('alamat_al'));

				$update = $this->M_alumni->proses_update_profil($data);

				if ($update) {
					$notif['update']	= "sukses";
				}
				else {
					$notif['update']	= "gagal";
				}
				$this->session->set_flashdata('notifikasi', $this->notif->sukses_edit());
				echo json_encode($notif);
			}
			else 
			{
				$notif['update'] = "<div class='pullquote-left'>".validation_errors()."</div>";
				echo json_encode($notif);
			}
		}
	}

	public function form_update_profil($id)
	{
		$data['profil'] = $this->M_alumni->get_profil_alumni($id);
		$data['title']	= "Update Profil";
		$this->load->library('googlemaps');
		$marker = array();
		$marker['draggable'] = true;
		$marker['ondragstart'] = '
		$("#lat_al").val("");
		$("#lng_al").val("");
		$("#kota_al").val("");';
		$marker['ondragend'] = '
		$("#lat_al").val( event.latLng.lat()).change();
		$("#lng_al").val( event.latLng.lng()).change();';
		if($data['profil']->lat_al ==  null){
			$config['center'] = 'auto';
			$config['zoom'] = '14';
			$config['onboundschanged'] = 'if (!centreGot) {
				var mapCentre = map.getCenter();
				marker_0.setOptions({
					position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
				});
			}
			centreGot = true';
			$this->googlemaps->initialize($config);

			$marker['position'] = 'auto';
			$marker['draggable'] = true;
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
		}
		else {
			$lat = $data['profil']->lat_al;
			$lng = $data['profil']->lng_al;

			$config['center'] = $lat.', '.$lng;
			$config['zoom'] = '14';
			$this->googlemaps->initialize($config);

			$lat = $data['profil']->lat_al;
			$lng = $data['profil']->lng_al;
			$marker['position'] = $lat.', '.$lng;
			$marker['infowindow_content'] = "Lokasi rumah Kamu, benar ? kalau bukan, update datanya ya";

			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
		}
		$data['halaman'] = 'alumni/form_profil';
		$this->template_alumni($data);
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

	public function not_found()
	{
		$data['halaman']		= "not_found";
		$this->template_alumni($data);
	}

}

/* End of file web_alumni.php */
/* Location: ./application/controllers/web_alumni.php */