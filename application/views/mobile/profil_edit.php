		<script type="text/javascript">
			var centreGot = false;
		</script>
		<style type="text/css">
			#shop{
				background-repeat: repeat-x;    
				height:80px;
				width: 80px;
				margin-left: 20px;
				margin-top: 13px;

			}

			#shop .content{    
				width: 80px; /*328 co je 1/3 - 20margin left*/
				height: 80px;
				line-height: 20px;
				margin-top: 0px;
				margin-left: 9px;
				margin-right:0px;
				display:inline-block;
				position:relative;

			}

			#shop .content a {
				position:absolute;
				bottom:-1px;
				right:0px;
				left:0px;
				background:white;
				color:black;
				

			}
		</style>
		<div data-role="popup" id="popup" data-theme="b" class="ui-corner-all">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			<?php echo form_open_multipart('mob_tampil/profil/edit_foto',array('data-ajax'=>'false')); ?>
			<div style="padding:10px 10px;">
				<h3>Change Profil Picture</h3>

				<input  type="file"  name="filefoto" accept="image/*" capture="filesystem">
				<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ">Submit</button>
			</div>
			<?php echo form_close();?>
		</div>
		
		
		<ul data-role="listview" data-inset="true"  data-theme="c" style="margin:0px;">
			<li style="background: white">
				<center>
					<div id="shop">
						<div class="content">
							<img width='70px' height="70px" src="<?=base_URL()?>assets/upload/alumni/<?php echo $alumni[0]['foto_al']; ?>"" style="border-radius: 500px; opacity: 0.5;
							filter: alpha(opacity=50);
							padding: 6px 6px 6px 6px;
							background: rgba(117, 175, 190, 0.3);
							float: left;
							background-position: 50% 50%;
							background-repeat: no-repeat;
							background-size: cover;"> 
							<a href="#popup" data-rel="popup" data-position-to="window" data-transition="pop" data-theme="b">Change</a>
						</div>
					</div>
				</center>
			</li>
			<?php echo form_open(base_url('mob_tampil/profil/act_edit'), array('data-ajax'=>'false')); ?>
			<li data-icon="false">

				<br>
				<label><b style="color:#A94442;">Username</b> </label>
				<br>
				<input type="text" class="error" name="username"  value="<?php echo $this->session->userdata('login')['username_al'];  ?>" disabled >
			</li>
			<li data-icon="false">

				<label style="float: left"><b style="color:#A94442;">Nama Lengkap</b></label><br>
				<input class="error" type="text" name="nama"  value="<?php echo $this->session->userdata('login')['nama_al'];  ?>" disabled>
			</li>

			<li data-icon="false">

				<label style="float: left"><b>Alamat *</b></label><br>
				<textarea type="text" name="alamat"><?php echo $alumni[0]['alamat_al'] ;?>
				</textarea>
			</li>
			<li data-icon="false">

				<label style="float: left"><b>Phone *</b></label><br>
				<input type="tel" name="phone" pattern="[0-9]*" value="<?php echo $alumni[0]['cp_al'] ;?>">
			</li>
			<li data-icon="false">

				<label style="float: left"><b>E-mail *</b></label><br>
				<input  type="email" name="email" value=" <?php echo $alumni[0]['email_al'] ;?>">
			</li>
			<?php
			if ($alumni[0]['alker_al']==null) {

			} else {?>
			<li data-icon="false">

				<label style='float: left'><b>Dimana Anda Bekerja</b></label><br>
				<input  type='text' name='alker'  value='<?=$alumni[0]['alker_al']?>' placeholder="opsional">
			</li>
			<?php
		}

		?>
		<div style="display: none">
			<input name="lat" placeholder="latitude" id="lat"  type="text" value="<?=$alumni[0]['lat_al']?>">
			<input name="lng" placeholder="longitude" id ="lng" type="text" value="<?=$alumni[0]['lng_al']?>">
			<input name="kota" placeholder="kota" id ="kota" type="text" value="<?=$alumni[0]['kota_al']?>" > 
		</div>
		<li data-icon="false">
			<b>Tag Youre Location Here! *</b>
			<hr>
			<div><?=$map['html'];?></div>

		</li>
		<hr>
	
				<button type="submit" data-inline="false" style="width: 100%" class="ui-btn ui-corner-all ui-shadow ui-btn-b center">Submit</button>
			</div>
			
	
		
	</ul>
	<?php echo $map['js']; ?> 
	<?php echo form_close(); ?>
	<script type="text/javascript">
		$(document).ready(function(){  
			$('#lat, #lng').on('change', function(){
				var d1=$('#lat').val();
				var d2=$('#lng').val();
				var baseurl = '<?php print base_url(); ?>';
				$.ajax({
					url: baseurl+'mob_tampil/get_lokasi'+'/'+d1+'/'+d2,
					type : 'GET',
					cache:false,
					success: function(data) {
						$('#kota').val(data);
					}
				});
			});
		});


	</script>