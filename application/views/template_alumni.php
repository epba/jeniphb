<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Bootstrap 3 template for corporate business" />
	<!-- css -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />	
	<link href="<?php echo base_url(); ?>assets/css/cubeportfolio.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets_b/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- Theme skin -->
	<link id="t-colors" href="<?php echo base_url(); ?>assets/skins/blue.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	
	<!-- boxed bg -->
	<!-- <link id="bodybg" href="<?php echo base_url(); ?>assets/bodybg/bg5.css" rel="stylesheet" type="text/css" /> -->
<!-- =======================================================
    Theme Name: Sailor
    Theme URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>
<body>
	<div id="wrapper">
		<!-- start header -->
		<header>
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.html"><img src="<?php echo base_url() ?>assets/img/logo.png" alt="" width="199" height="52" /></a>
					</div>
					<div class="navbar-collapse collapse ">
						<ul class="nav navbar-nav">
							<li>
								<a href="<?php echo base_url(); ?>web_alumni/beranda">Beranda</a>	
								<!-- isinya feed + post feed -->
							</li>
							<li>
								<a href="<?php echo base_url(); ?>web_alumni/loker">Lowongan Kerja</a>	
								<!-- all loker dibagi 2, my post all post-->
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Lingkup Alumni <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>web_alumni/sesama_alumni">Teman</a></li>
									<li><a href="<?php echo base_url(); ?>web_alumni/gis">GIS Alumni</a></li>
									<li><a href="<?php echo base_url(); ?>web_alumni/agenda">Agenda</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Akun <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>web_alumni/profil">Profil</a></li>
									<li><a href="<?php echo base_url().'web_alumni/form_update_profil/'.$this->session->userdata('data_login_alumni')['id_al'];?>">Edit Akun</a></li>
									<li><a href="<?php echo base_url(); ?>web_alumni/edit_password/form">Edit Password</a></li>
									<li><a href="<?php echo base_url(); ?>web_logout/alumni">Keluar</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- end header -->
		<!-- Halaman -->
		<?php $this->load->view($halaman); ?>
		<!-- Halaman -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-lg-3">
						<div class="widget">
							<h4>Get in touch with us</h4>
							<address>
								<strong>Sailor company Inc</strong><br>
								Sailor suite room V124, DB 91<br>
								Someplace 71745 Earth </address>
								<p>
									<i class="icon-phone"></i> (123) 456-7890 - (123) 555-7891 <br>
									<i class="icon-envelope-alt"></i> email@domainname.com
								</p>
							</div>
						</div>
						<div class="col-sm-3 col-lg-3">
							<div class="widget">
								<h4>Information</h4>
								<ul class="link-list">
									<li><a href="#">Press release</a></li>
									<li><a href="#">Terms and conditions</a></li>
									<li><a href="#">Privacy policy</a></li>
									<li><a href="#">Career center</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3 col-lg-3">
							<div class="widget">
								<h4>Pages</h4>
								<ul class="link-list">
									<li><a href="#">Press release</a></li>
									<li><a href="#">Terms and conditions</a></li>
									<li><a href="#">Privacy policy</a></li>
									<li><a href="#">Career center</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3 col-lg-3">
							<div class="widget">
								<h4>Newsletter</h4>
								<p>Fill your email and sign up for monthly newsletter to keep updated</p>
								<div class="form-group multiple-form-group input-group">
									<input type="email" name="email" class="form-control">
									<span class="input-group-btn">
										<button type="button" class="btn btn-theme btn-add">Subscribe</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="sub-footer">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<div class="copyright">
									<p>&copy; Sailor Theme - All Right Reserved</p>
									<div class="credits">
                            <!-- 
                                All the links in the footer should remain intact. 
                                You can delete the links only if you purchased the pro version.
                                Licensing information: https://bootstrapmade.com/license/
                                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Sailor
                            -->
                            <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                	<ul class="social-network">
                		<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                		<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                		<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                		<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                		<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                	</ul>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flexslider/jquery.flexslider-min.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flexslider/flexslider.config.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stellar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cubeportfolio.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/google-code-prettify/prettify.js"></script>
<script src="<?php echo base_url(); ?>assets/js/animate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>
</html>