<?php echo $this->session->flashdata('notifikasi'); ?>
<?php 
$act = $this->uri->segment(3);
if ($act=="add") {
	$id 			= "";
	$nim			= "";
	$nama			= "";
	$alamat			= "";
	$cp				= "";
	$email			= "";
	$alker			= "";
	$thn_lulus		= "";
}
elseif ($act == "edit"){
	$id 			= "";
	$nim			= "";
	$nama			= "";
	$alamat			= "";
	$cp				= "";
	$email			= "";
	$alker			= "";
	$thn_lulus		= "";
}
?>
<div class="box box-primary">
	<div class="box-header">

		Download File Excel berikut 
		<a href="<?php echo base_url(); ?>assets/upload/sekolah/Master_alumni.xlsx">
			<button class="btn btn-xs btn-primary" title="Download"><i class="fa fa-file"></i></button>
		</a>
		Isi data alumni pada file tersebut dan upload disini.
	</div>
	<?php echo form_open_multipart(base_url()."web_sekolah/upload_alumni"); ?>
	<div class="box-body">
		<div class="form-group">
			<label for="foto_lok" class="control-label">File Excel</label>
			<input type="file" name="excel" class="form-control">
		</div>
		<input type="submit" class="btn btn-primary" value="Unggah">
	</div>
	<?php echo form_close(); ?>
	<!-- <div class="box-body">
		<?php echo form_open_multipart('web_sekolah/tampung_data_alumni/'.$act."/".$id); ?>
		<div class="form-group">
			<label for="nim" class="control-label">Nim</label>
			<input type="text" name="nim_al" value="<?php echo $nim; ?>" class="form-control" id="nim"  required=""  />
		</div>
		<div class="form-group">
			<label for="nama" class="control-label">Nama</label>
			<input type="text" name="nama_al" class="form-control" id="nama" required="" ><?php echo $nama; ?>
		</div>
		<div class="form-group">
			<label for="alamat_al" class="control-label">Alamat Rumah</label>
			<textarea name="alamat_al" class="form-control" id="alamat_al"></textarea>
		</div>
		<div class="form-group">
			<label for="cp_al" class="control-label">Telp.</label>
			<input type="text" name="cp_al" class="form-control" value="<?php echo $cp; ?>" id="cp_al">
		</div>
		<div class="form-group">
			<label for="thn_lulus" class="control-label">Tahun Lulus</label>
			<input type="text" name="thn_lulus_al" class="form-control" value="<?php echo $thn_lulus; ?>" id="thn_lulus_al">
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-success">Save</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div> -->
</div>