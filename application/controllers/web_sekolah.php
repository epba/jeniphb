<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_sekolah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login_sekolah'))) {
			redirect('web_login/form/sklh','refresh');
		}
		$this->load->model('M_sekolah');
	}

	public function template_sekolah($data)
	{
		$kumpulan_data	=	array_merge(array("menu" => "sekolah/menu","logout" => "web_logout/sekolah"),$data);
		$this->load->view('template_adm_per', $kumpulan_data);
	}

	public function beranda()
	{
		$data['title']		= "Beranda";
		$data['halaman']	= "sekolah/halaman_beranda";
		$this->template_sekolah($data);
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
				$data['password_sklh']	=	$this->input->post('pass_lama');
				$data['password_baru']	=	$this->input->post('pass_baru');
				if($this->M_sekolah->update_pass($data)){
					$this->session->set_flashdata('notifikasi', $this->notif->sukses_edit());
					redirect('Web_sekolah/form_ganti_password','refresh');
				}
				else{
					$this->session->set_flashdata('notifikasi', $this->notif->fail_update_password());
					redirect('Web_sekolah/form_ganti_password','refresh');
				}
			}
			else
			{
				$error = validation_errors();
				$this->session->set_flashdata('notifikasi', $this->notif->validasi_update_password($error));
				redirect('Web_sekolah/form_ganti_password','refresh');
			}
		}
		else {
			$data['title']		= "Ganti Password";
			$data['halaman']	= "sekolah/form_ganti_password";
			$this->template_sekolah($data);
		}
	}
	

	public function data_alumni()
	{
		$data['title']		= "Data Alumni";
		$data['halaman']	= "sekolah/halaman_data_alumni";
		$data['alumni']		= $this->M_sekolah->get_data_alumni();
		$this->template_sekolah($data);
	}

	public function form_alumni()
	{
		if ($this->uri->segment(3) == "add") {
			$data['title']		= "Tambah Alumni";
			$data['halaman']	= "sekolah/form_alumni";	
		}
		elseif ($this->uri->segment(3) == "edit") {
			$data['title']		= "Edit Alumni";
			$data['halaman']	= "sekolah/form_alumni";	
		}
		$this->template_sekolah($data);
	}

	public function form_perusahaan()
	{
		if ($this->uri->segment(3) == "add") {
			$data['title']		= "Tambah Perusahaan";
			$data['halaman']	= "sekolah/form_perusahaan";	
		}
		elseif ($this->uri->segment(3) == "edit") {
			$data['title']		= "Edit Perusahaan";
			$data['halaman']	= "sekolah/form_perusahaan";	
		}
		$this->template_sekolah($data);
	}

	public function data_detail_perusahaan($id)
	{
		$data['perusahaan']	= $this->M_sekolah->get_detail_perusahaan($id);
		$data['loker']		= $this->M_sekolah->get_detail_loker($id);
		if ($data['perusahaan'] == null) {
			echo "null";
		}
		else
		{
			$data['title']	= "Detail Perusahaan";
			$data['halaman']= "sekolah/halaman_detail_perusahaan";
			$this->template_sekolah($data);
		}
	}

	public function tampung_data_perusahaan()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama','required|min_length[4]');
		$this->form_validation->set_rules('username','Username','required|min_length[3]');
		$this->form_validation->set_rules('cp','Contact','required|max_length[14]');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('alamat','Alamat','required|min_length[5]');
		$this->form_validation->set_rules('web','Website','');
		$this->form_validation->set_rules('fax','fax','');

		if($this->form_validation->run()) 
		{
			$new_id	= $this->M_sekolah->get_max_id_perusahaan();

			$data_general			= array(
				'id_per'		=> $new_id,
				'nama_per'		=> addslashes($this->input->post('nama')),
				'username_per'	=> addslashes($this->input->post('username')),
				'cp_per'		=> addslashes($this->input->post('cp')),
				'email_per'		=> addslashes($this->input->post('email')),
				'fax_per'		=> addslashes($this->input->post('fax')),
				'alamat_per'	=> addslashes($this->input->post('alamat')),
				'web_per'		=> addslashes($this->input->post('web')),
				'password_per'	=> password_hash("welcome",PASSWORD_BCRYPT),
				'add_by'		=> $this->session->userdata('data_login_sekolah')['id_sklh']
				);

			if (!empty($_FILES['foto_per']['name'])) // form mengandung foto
			{
				$extensi = explode("/",$_FILES['foto_per']['type']);
				$config['upload_path'] 	 = './assets/upload/perusahaan';
				$config['allowed_types'] = 'jpg|png|jpeg';	
				$config['file_name'] 	 = $new_id.".".$extensi[1];
				$this->upload->initialize($config);

				$kirim_data = $this->M_sekolah->proses_add("perusahaan",array_merge($data_general,array('logo_per' => $config['file_name'])));

				if($kirim_data) //simpan data ke db
				{ 
					//lakukan upload
					$this->load->library('upload', $config);
					// Jika gagal Upload
					if ( ! $this->upload->do_upload("foto_per"))
					{
						$error_upload = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('notifikasi', $this->notif->sukses_tanpa_foto($error_upload));
						redirect('web_sekolah/data_perusahaan','refresh');
					}
					//jika sukses upload
					else
					{ 
						$this->session->set_flashdata('notifikasi', $this->notif->sukses_add());
						redirect('web_sekolah/data_perusahaan','refresh');
					}
				}
				else // gagal menyimpan data ke db
				{
					$this->session->set_flashdata('notifikasi', $this->notif->fail());
					redirect('web_sekolah/data_perusahaan','refresh');
				}
			}
			else // form tidak mengandung foto
			{
				$kirim_data = $this->M_sekolah->proses_add("perusahaan",array_merge($data_general));
				if($kirim_data) //simpan data ke db
				{ 
					$this->session->set_flashdata('notifikasi', $this->notif->sukses_add());
					redirect('web_sekolah/data_perusahaan','refresh');
				}
				else
				{
					$this->session->set_flashdata('notifikasi', $this->notif->fail());
					redirect('web_sekolah/data_perusahaan','refresh');	
				}
			}
		}
		else 
		{
			$error = validation_errors();
			$this->session->set_flashdata('notifikasi', $this->notif->validasi($error));
			redirect('web_sekolah/form_perusahaan/add','refresh');
		}
	}

	public function tampung_data_alumni()
	{
		$this->form_validation->set_rules('nim_al','Nim','required');
		$this->form_validation->set_rules('nama_al','Nama','required');
		if($this->form_validation->run())     
		{
			$data['username_al']	= $this->session->userdata('data_login_sekolah')['id_sklh']."-".$this->input->post('nim_al');
			$data['nama_al']		= addslashes($this->input->post('nama_al'));
			$data['alamat_al']		= addslashes($this->input->post('alamat_al'));
			$data['cp_al']			= addslashes($this->input->post('cp_al'));
			$data['email_al']		= addslashes($this->input->post('email_al'));
			$data['id_sklh']		= $this->session->userdata('data_login_sekolah')['id_sklh'];

			if ($this->uri->segment(3) == "add") {
				if($this->M_sekolah->proses_add("alumni",$data)){
					$this->session->set_flashdata('notifikasi', $this->notif->sukses_add());
					redirect('Web_sekolah/data_alumni','refresh');
				}
				else
				{
					$this->session->set_flashdata('notifikasi', $this->notif->fail());
					redirect('Web_sekolah/data_alumni','refresh');
				}
			}
		}
		else {
			$error = validation_errors();
			$this->session->set_flashdata('notifikasi', $this->notif->validasi($error));
			redirect('Web_sekolah/form_alumni/add','refresh');
		}
	}

	public function hapus_data($id,$tabel)
	{
		if($this->M_sekolah->proses_hapus($id,$tabel)){
			$this->session->set_flashdata('notifikasi', $this->notif->sukses_hapus());
			redirect('web_sekolah/data_'.$tabel,'refresh');
		}
		else {
			$this->session->set_flashdata('notifikasi', $this->notif->fail_hapus());
			redirect('web_sekolah/data_'.$tabel,'refresh');
		}
	}

	public function upload_alumni()
	{
		$alumni = $this->input->post('excel');
		$config['upload_path']      = 'assets/upload/sekolah';
		$config['allowed_types']    = 'xls|xlsx';
		$config['file_name']        = date('y_h_i_s');
		$this->upload->initialize($config);     
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('excel'))
		{
			$error_upload = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('notifikasi', $this->notif->error_upload($error_upload));
			redirect('web_sekolah/data_alumni','refresh');
		}
		else
		{
			$data_upload = $this->upload->data();
			//get excell file name
			$file = 'assets/upload/sekolah/'.$data_upload['orig_name']; 
			$this->load->library('Excel');
            $objPHPExcel = PHPExcel_IOFactory::load($file); //load file excell from $file           
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection(); //collect data
            //extract to a PHP readable array format
            foreach ($cell_collection as $cell) 
            {
            	$kolom = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            	$baris = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            	$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            	if ($baris == 1) {
            		$header[$baris][$kolom]   = $data_value;
            	} else {
            		$arr_data[$baris][$kolom] = $data_value;
            	}
            }
            $data['header'] = $header;
            $data['values'] = $arr_data;  
//nilai awal keberhasilan / kegagalan upload
/**/        $sukses = 0;
/**/        $fail = 0;
//nilai awal keberhasilan / kegagalan upload
            //$pass , buat generate password default ditaroh diluar looping biar proses generate dilakukan sekali aja jadi ga bikin berat web
            $pass = password_hash("welcome",PASSWORD_BCRYPT);

            foreach ($data['values'] as $key) {
            	$data_alumni['id_al']			=  $this->session->userdata('data_login_sekolah')['id_sklh']."-".$key['A'];
            	$data_alumni['username_al']		=  $this->session->userdata('data_login_sekolah')['id_sklh']."-".$key['A'];
            	$data_alumni['nama_al']			=  addslashes($key['B']);
            	$data_alumni['thn_lulus_al']	=  addslashes($key['C']);
            	$data_alumni['password_al']		=  $pass;
            	$data_alumni['id_sklh']			=  $this->session->userdata('data_login_sekolah')['id_sklh'];
            	$cek_username	= $this->M_sekolah->cek_data_alumni($data_alumni['username_al']);
            	if($cek_username == "Accept"){
            		$sukses 	= $sukses+1;
            		$alumni[] 	= $data_alumni;
            	}
            	else {
            		$fail 		= $fail+1;
            	}
            }

            if($sukses != null){
            	$this->M_sekolah->proses_addbatch("alumni",$alumni);
            	@unlink("assets/upload/sekolah/".$data_upload['orig_name']);
            	$this->session->set_flashdata('notifikasi', $this->notif->excell($sukses,$fail));
            	redirect('web_sekolah/data_alumni','refresh');
            }
            else{
            	$this->session->set_flashdata('notifikasi', $this->notif->fail());
            	@unlink("assets/upload/sekolah/".$data_upload['orig_name']);
            	redirect('web_sekolah/data_alumni','refresh');
            }
        }
    }


    public function data_perusahaan()
    {
    	$data['title']		= "Data Perusahaan";
    	$data['halaman']	= "sekolah/halaman_data_perusahaan";
    	$data['perusahaan']	= $this->M_sekolah->get_perusahaan();
    	$this->template_sekolah($data);
    }

    public function data_loker()
    {
    	$data['title']		= "Data Loker";
    	$data['halaman']	= "sekolah/halaman_data_loker";
    	$data['loker']		= $this->M_sekolah->get_loker();
    	$this->template_sekolah($data);
    }

    public function data_detail_loker($id)
    {
    	$data['loker']		= $this->M_sekolah->get_detail_loker($id);
    	if ($data['loker'] == null) {
    		echo "null";
    	}
    	else
    	{
    		$data['title']		= "Detail Loker";
    		$data['halaman']	= "sekolah/halaman_detail_loker";
    		$this->template_sekolah($data);
    	}
    }

    public function acc_loker($id)
    {
    	$acc = $this->M_sekolah->proses_acc_loker($id);
    	if ($acc) {
    		$this->session->set_flashdata('notifikasi', $this->notif->sukses_edit());
    		redirect('web_sekolah/data_loker','refresh');	
    	}
    }

}

/* End of file institusi.php */
/* Location: ./application/controllers/institusi.php */