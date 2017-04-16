<script type="text/javascript">
	var centreGot = false;
</script>

<?php echo $this->session->flashdata('notifikasi'); ?>
<?php 
$act = $this->uri->segment(3);
if ($act=="add") {
	$id 				= "";
	$judul_lok			= "";
	$isi_lok			= "";
	$foto_lok			= "";
	$lng_lok			= "";
	$lat_lok			= "";
	$alamat_lok			= "";
	$time_end_lok		= "";
	$kota_lok			= "";
}
elseif ($act == "edit"){
	$id 				= $data_lama->id_lok;
	$judul_lok			= $data_lama->judul_lok;
	$isi_lok			= $data_lama->isi_lok;
	$foto_lok			= "";
	$lng_lok			= $data_lama->lng_lok;
	$lat_lok			= $data_lama->lat_lok;
	$alamat_lok			= $data_lama->alamat_lok;
	$time_end_lok		= $data_lama->time_end_lok;
	$kota_lok			= $data_lama->kota_lok;
}
?>
<div class="box box-primary">
	<div class="box-header">
	</div>
	<div class="box-body">
		<?php echo form_open_multipart('web_perusahaan/tampung_data_loker/'.$act."/".$id); ?>
		<div class="form-group">
			<label for="judul_lok" class="control-label">Judul Loker</label>
			<input type="text" name="judul_lok" value="<?php echo $judul_lok; ?>" class="form-control" id="judul_lok"  required=""  />
		</div>
		<div class="form-group">
			<label for="isi_lok" class="control-label">Konten</label>
			<textarea name="isi_lok" class="form-control textarea" id="isi_lok" required="" ><?php echo $isi_lok; ?></textarea>
		</div>
		<div class="form-group">
			<label for="foto_lok" class="control-label">Foto</label>
			<input type="file" name="foto_lok" id="foto_lok">
		</div>
		<div class="form-group">
			<label for="lat_lok" class="control-label">Latitude</label>
			<input type="text" id="lat_lok" name="lat_lok" class="form-control" value="<?php echo $lat_lok; ?>" >
		</div>
		<div class="form-group">
			<label for="lng_lok" class="control-label">Longitude</label>
			<input type="text" id="lng_lok" name="lng_lok" class="form-control" value="<?php echo $lng_lok; ?>" >
		</div>
		<div class="form-group">
			<label for="lng_lok" class="control-label">Kota</label>
			<input type="text" id="kota_lok" name="kota_lok" class="form-control" value="<?php echo $kota_lok; ?>">
		</div>
		<?= $map['html']; ?>
		<div class="form-group">
			<label for="alamat_lok" class="control-label">Alamat</label>
			<textarea name="alamat_lok" class="form-control textarea" required="" id="alamat_lok"><?php echo $alamat_lok; ?></textarea>
		</div>
		<div class="form-group">
			<label for="time_end_lok" class="control-label" >Masa Berlaku</label>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input class="form-control datepicker"  value="<?php echo date_format(date_create($time_end_lok),"Y-m-d") ?>" required="" name="time_end_lok" data-mask="" type="text">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-success">Save</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){  
		$('#lat_lok, #lng_lok').on('change', function(){
			var d1=$('#lat_lok').val();
			var d2=$('#lng_lok').val();
			var url = '<?php print base_url(); ?>'+'web_perusahaan/get_lokasi'+'/'+d1+'/'+d2;
			if (d1 != "" && d2 != "") {
				$.ajax({
					url: url,
					type : 'GET',
					cache:false,
					success: function(data) {
						$('#kota_lok').val(data);
					}
				});
			}
			else {
				$('#kota_lok').val("Mendeteksi Kota..., geser marker jika proses terlalu lama");
			}
		});
	});
</script>
<?php echo $map['js']; ?> 