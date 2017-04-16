<?php if (empty($loker)) { 
	redirect('web_alumni/not_found','refresh');
}
preg_match("/ADM|PER/", $this->uri->segment(4),$id);
?>
<script type="text/javascript">
	var centreGot = false;
</script>

<section id="content">
	<div class="container">
		<div class="col-lg-8">
			<h3><?php echo $loker->judul_lok; ?></h3>
			<span class="pullquote-left">
				Dibuka sampai :		<?php echo date_format(date_create($loker->time_end_lok),"d, M Y"); ?>
			</span>
			<br>
			<img src="<?php echo base_url().'assets/upload/loker/'.$loker->foto_lok;?>" class="img-responsive">
			<p>
				<?php echo $loker->isi_lok; ?>
				<p>
					<span class="highlight">Lokasi Loker</span>
					<?php echo $map['html']; ?>
				</p>
			</p>
		</div>
		<div id="directionsDiv"></div>
		<div class="col-lg-4">
			<aside class="right-sidebar">
				<div class="widget">
					<?php
					if ($this->uri->segment(5) != "track") {
						if ($id[0] =="PER"){
							?>
							<h5 class="widgetheading"><?php echo $loker->nama_per; ?></h5>
							<ul class="cat">
								<?php if (!empty($loker->alamat_per)) { ?>
								<li>
									<i class="fa fa-map"></i><a href="#">Alamat Perusahaan:</a>
									<br>
									<?php echo $loker->alamat_per; ?>
								</li>
								<?php } ?>
								<?php if (!empty($loker->email_per)) { ?>
								<li>
									<i class="fa fa-envelope"></i><a href="#">Email :</a>
									<br>
									<?php echo $loker->email_per; ?>
								</li>
								<?php } ?>
								<?php if (!empty($loker->cp_per)) { ?>
								<li>
									<i class="fa fa-phone"></i><a href="#">No. Telp :</a>
									<br>
									<?php echo $loker->cp_per; ?>
								</li>
								<?php } ?>
								<?php if (!empty($loker->fax_per)) { ?>
								<li>
									<i class="fa fa-phone"></i><a href="#">Fax:</a>
									<br>
									<?php echo $loker->fax_per; ?>
								</li>
								<?php } ?>
								<?php if (!empty($loker->web_per)) { ?>
								<li>
									<i class="fa fa-phone"></i><a href="#">Website:</a>
									<br>
									<?php echo $loker->web_per; ?>
								</li>
							</ul>
							<?php
						}
					}
					else
						{ ?>
					<h5 class="widgetheading"><?php echo $loker->tmp_lok; ?></h5>
					<ul class="cat">
						<li>
							<i class="fa fa-map"></i><a href="#">Lokasi Loker :</a>
							<br>
							<?php echo $loker->alamat_lok; ?>
						</li>
						<li>
							<i class="fa fa-calendar"></i><a href="#">Dibuka sampai :</a>
							<br>
							<?php echo date_format(date_create($loker->time_end_lok),"d, M Y"); ?>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Loker Lainya</h5>
					<ul class="recent">
						<?php foreach ($loker_lainya as $no => $data) { ?>
						<li>
							<img src="<?php echo base_url().'assets/upload/loker/'.$data->foto_lok; ?>" class="pull-left" style="width: 65px;height: 65px;" alt="">
							<h6><a href="<?php echo base_url().'web_alumni/detail_loker/'.$data->id_lok.'/'.$data->id_pengirim_lok; ?>"><?php echo $data->judul_lok; ?></a></h6>
							<p>
								Mazim alienum appellantur eu cu ullum officiis pro pri
							</p>
						</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
			</aside>
		</div>
		<?php echo $map['js']; ?>
	</div>
</section>