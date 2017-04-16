<section id="content">
	<div class="container">
		<div class="col-lg-8">
			<?php foreach ($loker as $no => $data_loker) { ?>
			<article>
				<div class="post-image">
					<div class="post-heading">
						<h3><a href="#"><?php echo $data_loker->judul_lok; ?></a></h3>
					</div>
					<?php if (!empty($data_loker->foto_lok)) { ?>
					<img src="<?php echo base_url().'assets/upload/loker/'.$data_loker->foto_lok;?>" alt="" class="img-responsive" style="max-height: 450px;">
					<?php } ?>
				</div>
				<p>
					<?php 
					$count_str = strlen($data_loker->isi_lok);
					echo character_limiter($data_loker->isi_lok,100);
					?>
				</p>
				<div class="bottom-article">
					<ul class="meta-post">
						<li><i class="fa fa-calendar"></i><a href="#"><?php echo date_format(date_create($data_loker->time_end_lok),"d, M Y"); ?></a></li>
						<li><i class="fa fa-user"></i><a href="#"> <?php echo $data_loker->tmp_lok; ?></a></li>
						<li><i class="fa fa-folder-open"></i><a href="#"> Blog</a></li>
						<li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
					</ul>
					<a href="<?php echo base_url().'web_alumni/detail_loker/'.$data_loker->id_lok.'/'.$data_loker->id_pengirim_lok; ?>" class="btn  btn-primary btn-xs pull-right">Continue reading <i class="fa fa-angle-right"></i></a>
				</div>
			</article>
			<?php } ?>
		</div>
		<div class="col-lg-4">
			<aside class="right-sidebar">
				<div class="widget">
					<form role="form">
						<div class="form-group">
							<input class="form-control" id="s" placeholder="Search.." type="text">
						</div>
					</form>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Categories</h5>
					<ul class="cat">
						<li><i class="fa fa-angle-right"></i><a href="#">Web design</a><span> (20)</span></li>
						<li><i class="fa fa-angle-right"></i><a href="#">Online business</a><span> (11)</span></li>
						<li><i class="fa fa-angle-right"></i><a href="#">Marketing strategy</a><span> (9)</span></li>
						<li><i class="fa fa-angle-right"></i><a href="#">Technology</a><span> (12)</span></li>
						<li><i class="fa fa-angle-right"></i><a href="#">About finance</a><span> (18)</span></li>
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Latest posts</h5>
					<ul class="recent">
						<li>
							<img src="img/dummies/blog/65x65/thumb1.jpg" class="pull-left" alt="">
							<h6><a href="#">Lorem ipsum dolor sit</a></h6>
							<p>
								Mazim alienum appellantur eu cu ullum officiis pro pri
							</p>
						</li>
						<li>
							<a href="#"><img src="img/dummies/blog/65x65/thumb2.jpg" class="pull-left" alt=""></a>
							<h6><a href="#">Maiorum ponderum eum</a></h6>
							<p>
								Mazim alienum appellantur eu cu ullum officiis pro pri
							</p>
						</li>
						<li>
							<a href="#"><img src="img/dummies/blog/65x65/thumb3.jpg" class="pull-left" alt=""></a>
							<h6><a href="#">Et mei iusto dolorum</a></h6>
							<p>
								Mazim alienum appellantur eu cu ullum officiis pro pri
							</p>
						</li>
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Popular tags</h5>
					<ul class="tags">
						<li><a href="#">Web design</a></li>
						<li><a href="#">Trends</a></li>
						<li><a href="#">Technology</a></li>
						<li><a href="#">Internet</a></li>
						<li><a href="#">Tutorial</a></li>
						<li><a href="#">Development</a></li>
					</ul>
				</div>
			</aside>
		</div>
	</div>
</section>