<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Notif {
	function __construct()
	{
		$this->sukses_open 	= '<div class="alert alert-info alert-dismissible">';
		$this->fail_open 	= '<div class="alert alert-danger alert-dismissible">';
		$this->button_close	= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
		$this->info 		= '<h4><i class="icon fa fa-info"></i> Info</h4>';
		$this->closing 		= '<p></div>';
	}


	function sukses_add()
	{
		$notif = $this->sukses_open.$this->button_close.$this->info.'Penambahan data sukses.'.$this->closing;
		return $notif;
	}

	function sukses_edit()
	{
		$notif = $this->sukses_open.$this->button_close.$this->info.'Data telah diperbarui.'.$this->closing;
		return $notif;
	}

	function sukses_tanpa_foto($error_upload)
	{
		$notif = $this->sukses_open.$this->button_close.$this->info.'Penambahan data sukses, sedangkan foto gagal disimpan.<p>'.$error_upload['error'].$this->closing;
		return $notif;
	}

	function error_upload($error_upload)
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Penambahan data gagal.<p>'.$error_upload['error'].$this->closing;
		return $notif;
	}

	function  fail()
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Penambahan data gagal.Data sudah ada'.$this->closing;
		return $notif;
	}

	function validasi($data)
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Penambahan data gagal.'.$data.$this->closing;
		return $notif;	
	}

	function validasi_update_password($data)
	{
		$notif = $this->fail_open.$this->button_close.$this->info.$data.$this->closing;
		return $notif;	
	}

	function sukses_hapus()
	{
		$notif = $this->sukses_open.$this->button_close.$this->info.'Data telah dihapus.'.$this->closing;
		return $notif;
	}

	function fail_hapus()
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Penghapusan Gagal.'.$this->closing;
		return $notif;
	}

	function fail_update()
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Gagal Update Data'.$this->closing;
		return $notif;
	}

	function fail_update_password()
	{
		$notif = $this->fail_open.$this->button_close.$this->info.'Password Lama Tidak Cocok'.$this->closing;
		return $notif;
	}

	function excell($sukses,$fail)
	{
		$notif = $this->sukses_open.$this->button_close.$this->info.'Total data tersimpan : '.$sukses.', Total data gagal tersimpan : '.$fail.$this->closing;
		return $notif;
	}
	
}

/* End of file notif.php */
/* Location: ./application/*models|controllers*/