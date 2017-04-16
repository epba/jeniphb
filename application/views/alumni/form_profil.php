<script type="text/javascript">
	var centreGot = false;
</script>

<?php 
$nama 	= (empty($profil->nama_al)) ? "" : $profil->nama_al ;
$email 	= (empty($profil->email_al)) ? "" : $profil->email_al ;
$cp 	= (empty($profil->cp_al)) ? "" : $profil->cp_al ;
$lat 	= (empty($profil->lat_al)) ? "" : $profil->lat_al ;
$lng 	= (empty($profil->lng_al)) ? "" : $profil->lng_al ;
$alrum 	= (empty($profil->alamat_al)) ? "" : $profil->alamat_al ;
$alker 	= (empty($profil->alker_al)) ? "" : $profil->alker_al ;
$kota 	= (empty($profil->kota_al)) ? "" : $profil->kota_al ;
?>
<section id="content">
	<div class="container">
		<form id="form_profil" method="post">
			<div class="col-lg-12">
				<div class="form-group row">
					<label class="col-2">email</label>
					<div class="col-8">
						<input class="form-control" value="<?php echo $email; ?>" type="email" id="email_al" name="email_al">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-2">No. Hp</label>
					<div class="col-8">
						<input class="form-control" value="<?php echo $cp; ?>" type="tel" id="cp_al" name="cp_al">
					</div>
				</div>
				<div class="row">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Alamat Rumah</h3>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row" style="display: none">
							<label class="col-lg-2">Latitude</label>
							<div class="col-lg-3">
								<input type="text" id="lat_al" name="lat_al" class="form-control" value="<?php echo $lat; ?>">
							</div>
						</div>
						<div class="form-group row" style="display: none">
							<label class="col-lg-2">Longitude</label>
							<div class="col-lg-3">
								<input type="text" id="lng_al" name="lng_al" class="form-control" value="<?php echo $lng; ?>">
							</div>
						</div>
						<div class="form-group row" style="display: none">
							<label class="col-lg-2">Kota</label>
							<div class="col-lg-3">
								<input class="form-control" value="<?php echo $kota; ?>" type="text" id="kota_al" name="kota_al">
							</div>
						</div>
						<div class="form-group row">
							<div class="text-center">
								<img src="<?php echo base_url(); ?>assets/img/load1.gif" id="load">
							</div>
							<label class="col-lg-6">Alamat Rumah Lengkap</label>
							<div class="col-lg-12">
								<textarea class="form-control" id="alamat_al" name="alamat_al"><?php echo $alrum; ?></textarea>
							</div>
						</div>
						<div class="label alert alert-info">Drag tanda marker pada peta ke lokasi rumah kamu.</div>
						<p>
						</div>
						<div class="text-center">
							<div class="col-lg-12 row">
								<?php echo $map['js'];?>
								<?php echo $map['html'];?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title">Alamat kerjanya dimana ?</h3>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-lg-12">
									<textarea class="form-control" id="alker_al" name="alker_al"><?php echo $alker; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-primary submit" value="Simpan">
			</form>
			<div id="output"></div>
		</div>
	</section>
	<!-- Button trigger modal -->
	<script type="text/javascript">
	$("#form_profil").on("submit",function (event){ // change
		event.preventDefault();
		var data = {
			email_al:$("#email_al").val(),
			cp_al:$("#cp_al").val(),
			lat_al:$("#lat_al").val(),
			lng_al:$("#lng_al").val(),
			alker_al:$("#alker_al").val(),
			alamat_al:$("#alamat_al").val(),
			kota_al:$("#kota_al").val()
		};
		var url_redirect = "<?php echo base_url().'web_alumni/profil';?>";
		var url = "<?php echo base_url().'web_alumni/update_profil/'.$this->session->userdata('data_login_alumni')['id_al']; ?>"
		$.ajax(
		{
			url : url,
			type: 'POST',
			data: data,
			dataType: 'JSON',
			success: function(data)
			{
				if (data['update'] == "sukses") {
					window.location = url_redirect;
				}
				else {
					$("#output").html(data['update']);
				}
			}	
		})
	});
	$(document).ready(function(){  
		$("#load").hide();
		if ($("#kota_al").val() == "") {
			$(".submit").hide();
		}
		$('#lat_al, #lng_al').change(function(){
			var d1 = $('#lat_al').val();
			var d2 = $('#lng_al').val();
			var url = '<?php print base_url(); ?>'+'web_alumni/get_lokasi'+'/'+d1+'/'+d2;
			if (d1 != "" && d2 != "") {
				$.ajax({
					url: url,
					type : 'GET',
					cache:false,
					beforeSend: function(){
						$("#load").show();
					},
					success: function(data) {
						var kota = data.trim();
						if(kota != "Unknown"){
							$('#kota_al').val(kota);
							$(".submit").show();
							$("#load").hide();
						}
						else {
							alert("Kamu gimana toh... ko sistem jadi bisa deteksi lokasi, coba geser marker");
						}
					}
				});
			}
			else {
				$('#kota').val("Mendeteksi Kota..., geser marker jika proses terlalu lama");
			}
		});
	});
</script>
