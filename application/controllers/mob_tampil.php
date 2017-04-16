<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mob_tampil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$logged_in 		= $this->session->userdata('login')['logged_in'];
		$this->id 		= $this->session->userdata('login')['id_al'];
		$this->id_sklh 	= $this->session->userdata('login')['id_sklh'];
		$this->uri3		= $this->uri->segment(3);
		$this->uri4		= $this->uri->segment(4);
		


		if (!$logged_in || $logged_in !== true) {
			redirect(base_url('login'));
		}
		
		



	}

	function coba_feed()
	{
		$this -> load->model('content_model');
		$total_data = $this->content_model->get_all_count();
		$content_per_page = 5; 
		$this->data['total_data'] = ceil($total_data->tol_records/$content_per_page);
		$this->data['title'] ='feeds';
/*		$this->load->view('mobile/template',$this->data);
*//*		$this->load->view('mobile/main_menu');
*/		$this->load->view('mobile/feeds', $this->data, FALSE);

/*		$this->load->view('mobile/footer');
*/	}

public function load_more()
{
	$this -> load->model('content_model');
	$group_no = $this->input->post('group_no');
	$content_per_page = 5;
	$start = ceil($group_no * $content_per_page);

	$all_content['all_content'] = $this->content_model->get_all_content($start,$content_per_page);

	$this->load->view('mobile/isinya', $all_content);


}

function index()
{	

	$this->load->model('mob_profil');
	$d = $this->mob_profil->my_profil();
	$array = array('a' =>'','alamat' => $d->alamat_al, 'kota' => $d->kota_al, 'lat' => $d->lat_al, 'lng' => $d->lng_al);

	$counts = array_count_values($array);
	$isi = $counts[''];
	if ($isi > 1 ) {
		$this->session->set_flashdata("k", "<div class=\"error\">Lengkapi Data Anda</div>");
		redirect(base_url('mob_tampil/profil/edit/'.$this->id));
	} 

	$data['title'] = 'Feeds';
	$this->load->model('mob_feeds');
	$jumlah = $this->mob_feeds->jumlah();
	$config['base_url'] = base_url().'mob_tampil/index/';
	$config['total_rows'] = $jumlah;
	$config['per_page'] = 5;
	$config['display_pages'] = FALSE;
	$config['full_tag_open'] = '<ul>';
	$config['full_tag_close'] = '</ul>';
	$config['next_link'] = 'Next <i class="fa fa-chevron-right"></i>';
	$config['next_tag_open'] = '<label> &nbsp; &nbsp;';
	$config['next_tag_close'] = '</label>';
	$config['prev_link'] = '<i class="fa fa-chevron-left"></i> Previous';
	$config['prev_tag_open'] = '<label> &nbsp; &nbsp;';
	$config['prev_tag_close'] = '</label>';
	$config['cur_tag_open'] = '<label><a href="">';
	$config['cur_tag_close'] = '</a></label>';

	/*feedku*/		
	$this->load->model('mob_feeds');
	$data['row'] = $this->mob_feeds->my_feeds();

	/*all data feed*/
	$data['feeds'] = $this->mob_feeds->all_feeds($config['per_page'],$this->uri3);
	$this->pagination->initialize($config); 

	/*update*/		
	if ($this->uri3	 == 'update') {
		$up = array(
			'isi_feed' => $this->input->post('isi'),
			'time_feed' => date('l, j F Y h:i A') 
			);
		$this->db->where('id_al', $this->id );
		$this->db->update('feed', $up);
		$this->session->set_flashdata("k", "<div class=\"sukses\">Sukses</div>");
		redirect(base_url('mob_tampil'));

	} else {
		/*view*/
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/main_menu');
		$this->load->view('mobile/feeds',$data);
		$this->load->view('mobile/footer');
	}

}



function bars()
{
	$data['title']   = 'Menu';

	/*sekolah*/
	$this->load->model('mob_bars');
	$data['skl'] = $this->mob_bars->sekolah();

	/*profilku*/
	$this->load->model('mob_profil');
	$data['aku'] = $this->mob_profil->my_profil();

	/*view*/
	$this->load->view('mobile/template',$data);
	$this->load->view('mobile/main_menu');
	$this->load->view('mobile/bars',$data);
	$this->load->view('mobile/footer');
}


function get_lokasi($lat, $lng) 
{ 

	if($lat == '' or $lng == '' && ($lat == '' && $lng =='')) { 
		echo "unknown";
	} elseif ($lat != '' && $lng != '') {
		$this->load->library('googlemaps');
		$this->load->library('Lbs');
		$get = $this->lbs->getAddress($lat, $lng);
		if(!isset($get['response']['city']) or $get['response']['city'] == null) {
			echo "Unknown";
		} else {
			echo $get['response']['city'];
		}

	}




}



function loker()
{	
	$data['title']   = 'Loker';
	$sql = $this->db->get_where('alumni', array('id_al' => $this->id));
	$data['alumni'] = $sql->result_array();
	$this->load->model('mob_loker');
	$jumlah= $this->mob_loker->jumlah();
	$config['base_url'] = base_url().'mob_tampil/loker/';
	$config['total_rows'] = $jumlah;
	$config['per_page'] = 5;
	$config['display_pages'] = FALSE;
	$config['full_tag_open'] = '<ul>';
	$config['full_tag_close'] = '</ul>';
	$config['next_link'] = 'Next <i class="fa fa-chevron-right"></i>';
	$config['next_tag_open'] = '<label>&nbsp;&nbsp;';
	$config['next_tag_close'] = '</label>';
	$config['prev_link'] = '<i class="fa fa-chevron-left"></i> Previous';
	$config['prev_tag_open'] = '<label> &nbsp;  &nbsp;';
	$config['prev_tag_close'] = '</label>';

	/*data my post*/  
	$this->load->model('mob_loker');
	$jumlah2= $this->mob_loker->jumlah_me();
	$config2['base_url'] = base_url().'mob_tampil/loker/me/';
	$config2['total_rows'] = $jumlah;
	$config2['per_page'] = 5;
	$config2['display_pages'] = FALSE;
	$config2['full_tag_open'] = '<ul>';
	$config2['full_tag_close'] = '</ul>'; 
	$config2['next_link'] = 'Next <i class="fa fa-chevron-right"></i>';
	$config2['next_tag_open'] = '<label>&nbsp;&nbsp;';
	$config2['next_tag_close'] = '</label>';
	$config2['prev_link'] = '<i class="fa fa-chevron-left"></i> Previous';
	$config2['prev_tag_open'] = '<label> &nbsp;  &nbsp;';
	$config2['prev_tag_close'] = '</label>';
	$config2['cur_tag_open'] = '<label><a href="">';
	$config2['cur_tag_close'] = '</a></label>';
	$data['loker'] = $this->mob_loker->loker($config['per_page'],$this->uri3);
	$this->pagination->initialize($config); 
	$data['loker_me'] = $this->mob_loker->loker_me($config2['per_page'],$this->uri3);
	$this->pagination->initialize($config2); 



	if ($this->uri3 == 'post') {
		$data['title'] = 'Post Job';
		$this->load->library('googlemaps');
		$marker = array();
		$marker['center'] = 'auto';
		$marker['infowindow_content'] = 'Im here';
		$marker['onclick'] = '
		$("#lat").val( event.latLng.lat()).change(); $("#lng").val( event.latLng.lng()).change();
		';
		$marker['onboundschanged'] = 'if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;
		';
		$this->googlemaps->initialize($marker);


		$marker = array();
		$marker['position'] = 'center';
		$marker['infowindow_content'] = 'im here';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#lat").val( event.latLng.lat()).change(); $("#lng").val( event.latLng.lng()).change();';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/back');
		$this->load->view('mobile/form_loker');
		$this->load->view('mobile/footer');

	} elseif ($this->uri3 == 'act_post' && $_FILES['gambar']['name'] != null && $this->input->post('kota') != 'Unknown') {
		$this->load->library('upload');
		$nmfile = $this->id.'_'.time();
		$config['upload_path'] = './assets/upload';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
		$config['file_name'] = $nmfile; 
		$this->upload->initialize($config);

		if ($this->upload->do_upload('gambar')) {
			$gbr       = $this->upload->data();
			$data = array(
				'id_pengirim_lok'		=> 	$this->id,
				'tmp_lok'			    =>  $this->input->post('tempat'),
				'judul_lok'			  	=>  $this->input->post('jdl'),
				'isi_lok'			    =>  $this->input->post('isi'),
				'foto_lok' 			  	=>	$gbr['file_name'],
				'lng_lok'			    =>  $this->input->post('lng'),
				'lat_lok'			    =>  $this->input->post('lat'),
				'kota_lok'		  		=>  $this->input->post('kota'),
				'alamat_lok'		  	=>  $this->input->post('alamat'),
				'time_lok'        		=>  date('Y-m-d'),
				'time_end_lok'			=>  $this->input->post('time_end'),
				'verifikasi_lok'		=>  0,
				'verifikasi_by_lok'		=>  $this->id_sklh
				);
			$this->db->insert('loker', $data);
			$config2['image_library'] = 'gd2'; 
			$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2['new_image'] = './assets/upload/loker';
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 400;
			$config2['height'] = 400;
			$this->load->library('image_lib',$config2); 
			$this->image_lib->initialize($config2);

			if ( !$this->image_lib->resize()) {
				$this->session->set_flashdata('k','<div class=\"error\">'.$this->image_lib->display_errors('', '').'</div>' );
			}
			@unlink($config2['source_image']);
			$this->session->set_flashdata("k", "<div class=\"sukses\">Sukses</div> ");
			redirect('mob_tampil/loker');

		} else {
			$this->session->set_flashdata("k", "<div class=\"error\">invalid</div> ");
			redirect('mob_tampil/loker');
		}

	} elseif ($this->uri3 == 'edit') {
		$this->load->library('googlemaps');
		$marker = array();
		$marker['center'] = 'auto';
		$marker['infowindow_content'] = 'Im here';
		$marker['onclick'] = '
		$("#lat").val( event.latLng.lat()).change(); $("#lng").val( event.latLng.lng()).change();
		';
		$marker['onboundschanged'] = 'if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;
		';
		$this->googlemaps->initialize($marker);


		$marker = array();
		$marker['position'] = 'center';
		$marker['infowindow_content'] = 'im here';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#lat").val( event.latLng.lat()).change(); $("#lng").val( event.latLng.lng()).change();';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->model('mob_loker');
		$data['row'] = $this->mob_loker->view();
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/back');
		$this->load->view('mobile/form_loker');
		$this->load->view('mobile/footer');

	} elseif ($this->uri3 == 'act_edit') {
		$this->load->library('upload');
		$nmfile = $this->uri->segment(4);
		$config['upload_path'] = './assets/upload';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

       /* $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px*/

        $config['file_name'] = $nmfile;
        $this->upload->initialize($config);

        if($_FILES['gambar']['name']) {
        	if ($this->upload->do_upload('gambar')) {
        		$sql  = $this->db->get_where('loker', array('id_lok' => $this->uri3))->row();
        		$old        = $sql->foto_lok;
        		$path       = './assets/upload/'.$old;
        		@unlink($path);

        		$gbr = $this->upload->data();
        		$data = array(
        			'tmp_lok'     		=>  $this->input->post('tempat'),
        			'judul_lok'    		=>  $this->input->post('jdl'),
        			'isi_lok'     		=>  $this->input->post('isi'),
        			'foto_lok'      	=>  $gbr['file_name'],
        			'lng_lok'     		=>  $this->input->post('lng'),
        			'lat_lok'     		=>  $this->input->post('lat'),
        			'alamat_lok'    	=>  $this->input->post('alamat'),
        			'time_lok'      	=>  date('Y-m-d'),
        			'time_end_lok'    	=>  $this->input->post('time_end')
        			);
        		$this->db->where('id_lok', $aksi);
        		$this->db->update('loker', $data);

        		/*resize*/
        		$config2['image_library'] = 'gd2'; 
        		$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        		$config2['new_image'] = './assets/upload/loker';
        		$config2['maintain_ratio'] = TRUE;
        		$config2['width'] = 400;
        		$config2['height'] = 400;
        		$this->load->library('image_lib',$config2); 
        		$this->image_lib->initialize($config2);

        		if ( !$this->image_lib->resize()) {
        			$this->session->set_flashdata('k','<div class=\"error\">'.$this->image_lib->display_errors('', '').'</div>' );
        		}

        		@unlink($config2['source_image']);
        		$this->session->set_flashdata("k", "<div class=\"sukses\">Sukses</div> ");
        		redirect('mob_tampil/loker');
        	} else {
        		$this->session->set_flashdata("k", "<div class=\"error\">Gagal</div> ");
        		redirect('mob_tampil/loker');
        	}
        }

    } elseif ($this->uri3 == 'delete') {
    	$this->db->delete('loker', array('id_lok' => $this->uri4));
    	$this->session->set_flashdata("k", "<div class=\"sukses\">Sukses</div> ");
    	redirect('mob_tampil/loker');

    } elseif ($this->uri3 == 'view') {
    	$data['title'] = 'Detail Job Post';
    	$this->load->model('mob_loker');
    	$data['row'] = $this->mob_loker->view();

    	/*view*/
    	$this->load->view('mobile/template',$data);
    	$this->load->view('mobile/back');
    	$this->load->view('mobile/loker_view');
    	$this->load->view('mobile/footer');

    } elseif ($this->uri3 == 'track') {
    	$data['title'] = 'Track Loker';
    	$this->load->model('mob_loker');
    	$sql = $this->mob_loker->track();
    	$this->load->library('googlemaps');
    	$config['center'] = 'auto';
    	$config['zoom'] = '3';
    	$config['directions'] = TRUE;
    	$config['directionsStart'] = 'auto';
    	$config['directionsEnd'] = ''.$sql->lat_lok.', '.$sql->lng_lok.'';
    	$config['directionsDivID'] = 'directionsDiv';

    	$this->googlemaps->initialize($config);
    	$data['map'] = $this->googlemaps->create_map();

    	/*view*/
    	$this->load->view('mobile/template',$data);
    	$this->load->view('mobile/back');
    	$this->load->view('mobile/loker_track');
    	$this->load->view('mobile/footer');

    } elseif ($this->uri3 == 'tracking') {
    	
    	$this->load->model('mob_loker');
    	$sql = $this->mob_loker->track();
    	$this->load->library('googlemaps');
    	$config['center'] = 'auto';
    	$config['zoom'] = '3';
    	$config['directions'] = TRUE;
    	$config['directionsStart'] = 'auto';
    	$config['directionsEnd'] = ''.$sql->lat_lok.', '.$sql->lng_lok.'';
    	$config['directionsDivID'] = 'directionsDiv';

    	$this->googlemaps->initialize($config);
    	$data['map'] = $this->googlemaps->create_map();

    	/*view*/
    	
    	$this->load->view('mobile/loker_track_2');
    	
    } else {
    	/*view*/
    	$this->load->view('mobile/template',$data);
    	$this->load->view('mobile/main_menu');
    	$this->load->view('mobile/loker');
    	$this->load->view('mobile/footer');
    }

}



function profil()
{	
	$data['title']   = 'Profil';
	$this->load->model('mob_profil');
	$this->load->library('form_validation');
	$sql = $this->db->get_where('alumni', array('id_al' => $this->id));
	$data['alumni'] = $sql->result_array();
	$this->db->select('isi_feed');
	$this->db->join('feed', 'alumni.id_al = feed.id_al');
	$where = "alumni.id_al = '$this->id'";
	$this->db->where($where);
	$sts= $this->db->get('alumni');
	$data['status'] = $sts->result_array();

	if ($this->uri3 == "edit") {
		$data['title']   = 'Update Profil';
		$this->load->library('googlemaps');
		$this->load->model('mob_profil');
		$profil= $this->mob_profil->my_profil();
		$marker = array();
		$marker['position'] = $profil->lat_al.', '.$profil->lng_al;
		$marker['infowindow_content'] = 'im here';
		$marker['draggable'] = true;
		$marker['ondragend'] = '$("#lat").val( event.latLng.lat()).change(); $("#lng").val( event.latLng.lng()).change();';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/back');
		$this->load->view('mobile/profil_edit');

	} elseif ($this->uri3 == "act_edit") {
		$data = array(
			'alamat_al' => $this->input->post('alamat'),
			'cp_al' 	=> $this->input->post('phone'),
			'email_al' 	=> $this->input->post('email'),
			'alker_al' 	=> $this->input->post('alker'),
			'lng_al'	=> $this->input->post('lng'),
			'lat_al'	=> $this->input->post('lat'),
			'kota_al'	=> $this->input->post('kota')
			);
		$this->db->where('id_al', $this->id);
		$this->db->update('alumni', $data);
		$this->session->set_flashdata("k", "Profil diperbaharui ");
		redirect('mob_tampil/profil/'.$this->id);

	} elseif ($this->uri3 == 'edit_password') {
		$data['title'] = 'Change Password';
		$this->load->view('mobile/template',$data);	
		$this->load->view('mobile/back');	
		$this->load->view('mobile/profil_password');

	} elseif ($this->uri3 == 'act_edit_password') {
		$this->form_validation->set_rules('old_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|matches[re_password]');
		$this->form_validation->set_rules('re_password', 'Retype Password', 'required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('mobile/template');		
			$this->load->view('mobile/profil_password');

		} else {
			$query = $this->mob_profil->checkOldPass(md5($this->input->post('old_password')));

			if($query) {
				$this->mob_profil->saveNewPass(md5($this->input->post('newpassword')));
				$this->session->set_flashdata("k", "Password Update ");
				redirect('mob_tampil/profil/edit_password');

			} else {
				$this->session->set_flashdata("k", "OLD password Wrong ".'<br>');
				redirect('mob_tampil/profil/edit_password');
			}
		}

	} elseif ($this->uri3 == 'foto') {
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/back');
		$this->load->view('mobile/profil_foto',$data);

	}elseif ($this->uri3 == 'edit_foto') {
		$this->load->library('upload');
		$nmfile = $this->id;
		$config['upload_path'] = './assets/upload';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
       /* $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px*/
        $config['file_name'] = $nmfile;
        $this->upload->initialize($config);

        if($_FILES['filefoto']['name']) {
        	if ($this->upload->do_upload('filefoto')) {
        		$gbr = $this->upload->data();
        		$data = array(
        			'foto_al' =>$gbr['file_name']
        			);
        		$this->db->where('id_al', $this->id);
        		$this->db->update('alumni', $data);
        		$config2['image_library'] = 'gd2'; 
        		$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        		$config2['new_image'] = './assets/upload/alumni';
        		$config2['maintain_ratio'] = TRUE;
        		$config2['width'] = 400;
        		$config2['height'] = 400;
        		$this->load->library('image_lib',$config2); 
        		$this->image_lib->initialize($config2);

        		if ( !$this->image_lib->resize()) {
        			$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
        		}
        		@unlink($config2['source_image']);
        		$this->session->set_flashdata("k", "<div class=\"sukses\">Sukses</div>");
        		redirect('mob_tampil/profil/'.$this->id);
        	} else {
        		$this->session->set_flashdata("k", "<div class=\"error\">Gagal</div>");
        		redirect('mob_tampil/profil/'.$this->id);
        	}
        }

    } else {
    	
    	$sql = $this->db->get_where('alumni', array('id_al' => $this->uri3));
    	$b = $this->db->get_where('alumni', array('id_al' => $this->uri3))->row();
    	$this->load->library('googlemaps');
    	$config['center'] = 'auto';
    	$config['zoom'] = '3';
    	$config['directions'] = TRUE;
    	$config['directionsStart'] = 'auto';
    	$config['directionsEnd'] = ''.$b->lat_al.', '.$b->lng_al.'';
    	$config['directionsDivID'] = 'directionsDiv';
    	$this->googlemaps->initialize($config);

    	$data['map'] = $this->googlemaps->create_map();
    	$data['alumni'] = $sql->result_array();
    	$this->db->select('*');
    	$this->db->from('alumni');
    	$this->db->join('feed', 'alumni.id_al = feed.id_al');
    	$this->db->where('feed.id_al', $this->uri3);
    	$sts = $this->db->get();
    	$data['status'] = $sts->result_array();
    	$this->load->view('mobile/template',$data);
    	$this->load->view('mobile/back');
    	$this->load->view('mobile/profil');
    }

}



function sekolah()
{
	$data['title']   = 'Instansi';
	$sql = $this->db->get_where('sekolah', array('id_sklh' => $this->uri3));
	$data['sekolah'] = $sql->result_array();
	$this->load->view('mobile/template',$data);		
	$this->load->view('mobile/back');
	$this->load->view('mobile/profil_sekolah');
	$this->load->view('mobile/footer');
}



function grup()
{
	$data['title']   = 'Grup';
	$this->load->model('mob_grup');

	if ($this->uri3 == 'member') {
		$sql = $this->mob_grup->member();
		foreach ($sql as $row) {
			$data['id_al'][] = $row->id_al;
			$data['nama_al'][] = $row->nama_al;
			$data['foto_al'][] = $row->foto_al;
		}
		$data['jlh'] =  count($sql);
		$data['title'] = 'Cari Teman';
		// view
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/back', $data);
		$this->load->view('mobile/grup_member_search');

	} else if ($this->uri3 == 'agenda') {
		$sql = $this->mob_grup->agenda();
		foreach ($sql as $row) {
			$data['id_ag'][] = $row->id_ag;
			$data['judul_ag'][] = $row->judul_ag;
			$data['tmp_ag'][] = $row->tmp_ag;
			$data['isi_ag'][] = $row->isi_ag;
			$data['foto_ag'][] = $row->foto_ag;
			$data['time_ag'][] = $row->time_ag;
			$data['post_ag'][] = $row->post_by_ag;
		}
		$data['jlh'] =  count($sql);

		/*view*/
		$this->load->view('mobile/template',$data);
		$this->load->view('mobile/grup_agenda');
	}

}




function tracer()
{
	$data['title'] = 'Sebaran Alumni';
	$this->load->library('googlemaps');
	$this->load->model('mob_track_al');
	$temp_result = $this->mob_track_al->get_location()->result();
	$marker = array();
	foreach ($temp_result as $value) {
		$marker['position'] = $value->kota_al;
		$marker['center'] = 'indonesia';
		$marker['zoom'] = 5 ;
		$this->googlemaps->add_marker($marker);	
	}

	$this->googlemaps->initialize($marker);
	$data['map'] = $this->googlemaps->create_map();
	$data['kota'] = $this->mob_track_al->get_all()->result();
	$data['jmlh'] = $this->mob_track_al->jumlah_kerja()->result();
	$data['jm_kota'] = $this->mob_track_al->count_get_all_kerja()->num_rows();
	$data['jm_jmlh'] = $this->mob_track_al->count_get_all()->num_rows();
	/*var_dump($data['kota']);
	exit;*/

	$this->load->view('mobile/template',$data);
	$this->load->view('mobile/back');
	$this->load->view('mobile/tracer');
}


function chat() 
{
	$this->load->model("model_user");
	$this->load->model("model_chat");
	$data['title'] 	= 'chat';
	
	$data['user']   = $this->model_user->getAll(array("id_al !=" => $this->id));

	
/*	$data['chat']   = $this->model_user->getAll_chat(array("send_to" => $this->id));
*/	


/*chat terakhir*/


/*	$where  = "(( (send_by = '$id_al' AND send_to = '$id')) AND chat_id > '$id_max')";
$chat   = $this->model_chat->getAll($where);*/

/*$this->db->limit(1);*/

$this->load->view('mobile/template',$data);
$this->load->view('mobile/back');
$this->load->view('mobile/chat',$data);
}


function pesan()
{
	$this->load->model("model_user");
	$this->load->model("model_chat");

        $id_al    = $this->uri3; //tujuan
        $id         = $this->id; //dari
        $id_max     = $this->input->post('id_max'); //dari

        $where  = "(((send_to = '$id_al' AND send_by = '$id') OR (send_by = '$id_al' AND send_to = '$id')) AND chat_id > '$id_max')";

        $data['user'] = $this->db->get_where('alumni', array('id_al' => $id_al))->row();


        $chat   = $this->model_chat->getAll($where);
        $data['id_max']     = $id_max;
        $data['id_al']    = $id_al;
        $data['chat']       = $chat;


        $data['title']	= '<i class="fa fa-comments"> &nbsp; &nbsp; </i> '.$data['user']->nama_al;
        $this->load->view('mobile/template',$data);
        $this->load->view('mobile/back');
        $this->load->view("mobile/chat",$data);
    }

    function getChat(){
    	$this->load->model("model_user");
    	$this->load->model("model_chat");

        $id_al    = $this->input->post("id_al",true); //tujuan
        $id         = $this->id; //dari
        $id_max     = $this->input->post('id_max'); //dari

        $where  = "(((send_to = '$id_al' AND send_by = '$id') OR (send_by = '$id_al' AND send_to = '$id')) AND chat_id > '$id_max')";
        $chat   = $this->model_chat->getAll($where);
        $data['id_max']     = $id_max;
        $data['id_al']    = $id_al;
        $data['chat']       = $chat;
        $this->load->view("mobile/vwChatBox",$data);
    }
    
    function getChatAll(){
    	$this->load->model("model_user");
    	$this->load->model("model_chat");

        $id_al    = $this->input->post("id_al",true); //tujuan
        $id         = $this->id; //dari
        $id_max     = $this->input->post('id_max'); //dari

        $where  = "(((send_to = '$id_al' AND send_by = '$id') OR (send_by = '$id_al' AND send_to = '$id')))";
        $chat   = $this->model_chat->getAll($where);
        
        $where2 = "(((send_to = '$id_al' AND send_by = '$id') OR (send_by = '$id_al' AND send_to = '$id')) AND chat_id > '$id_max')";
        $get_id = $this->model_chat->getLastId($where2);
        
        $data['id_max']     = $get_id['chat_id'];
        $data['id_al']    = $id_al;
        $data['chat']       = $chat;

        $this->load->view("mobile/vwChatBox",$data);
    }
    
    function getLastId(){
    	$this->load->model("model_user");
    	$this->load->model("model_chat");

        $id_al    = $this->input->post("id_al",true); //tujuan
        $id         = $this->id; //dari
        $id_max     = $this->input->post('id_max'); //dari
        
        $where  = "(((send_to = '$id_al' AND send_by = '$id') OR (send_by = '$id_al' AND send_to = '$id')) AND chat_id > '$id_max')";
        $get_id = $this->model_chat->getLastId($where);
        
        echo json_encode(array("id" => $get_id['chat_id'] != '' ?  $get_id['chat_id'] : $id_max ));
    }
    
    function sendMessage(){
    	$this->load->model("model_chat");
        $id_al    = $this->input->post("id_al",true); //tujuan/send_by
        $id         = $this->id; //dari
        $message      = addslashes($this->input->post("message",true));
        
        $data   = array(
        	'send_to' => $id_al,
        	'send_by' => $id,
        	'message' => $message,
        	);
        
        $query  =   $this->model_chat->getInsert($data);
        
        if($query){
        	$rs = 1;
        }else{
        	$rs = 2;
        }
        
        echo json_encode(array("result"=>$rs));
        
    }



    function getchatname() {
    	$id = $this->input->post('alumni_id');
    	$nama = $this->db->where('id_al', $id)->get('alumni')->row();
    	echo $nama->nama_al;
    }

}
