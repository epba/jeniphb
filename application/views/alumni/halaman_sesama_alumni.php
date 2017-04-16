<script>
	function searchFilter(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>web_alumni/ajax_pagination_alumni/'+page_num,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {
				$('#sesama_alumni').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}
</script>
<style type="text/css">
	/* Pagination */
	div.pagination {
		font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
		padding:2px;
		margin: 20px 10px;
		float: right;
	}

	div.pagination a {
		margin: 2px;
		padding: 0.5em 0.64em 0.43em 0.64em;
		background-color: #FD1C5B;
		text-decoration: none; /* no underline */
		color: #fff;
	}
	div.pagination a:hover, div.pagination a:active {
		padding: 0.5em 0.64em 0.43em 0.64em;
		margin: 2px;
		background-color: #FD1C5B;
		color: #fff;
	}
	div.pagination span.current {
		padding: 0.5em 0.64em 0.43em 0.64em;
		margin: 2px;
		background-color: #f6efcc;
		color: #6d643c;
	}
	div.pagination span.disabled {
		display:none;
	}
	.pagination ul li{display: inline-block;}
	.pagination ul li a.active{opacity: .5;}

	/* loading */
	.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
	.loading .content {
		position: absolute;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		top: 50%;
		left: 0;
		right: 0;
		text-align: center;
		color: #555;
	}
</style>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="text-center">
				<h2>Temukan sesama alumni <span class="highlight"><?php echo $asal_sekolah->nama_sklh; ?></span></h2>					
				<p>		
					<h4>Ayo saling bantu sesama, share informasi lowongan pekerjaan yang ada.</h4>
				</p>		
			</div>
		</div>
	</div>
</section>
<section id="data_Alumni">
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center">
				<form>
					<div class="form-group has-feedback">
						<label for="search" class="sr-only">Search</label>
						<input type="text" class="form-control" name="search" id="keywords" placeholder="search" onkeyup="searchFilter();">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</form>
			</div>
		</div>
	</div>	

	<div class="container" id="sesama_alumni">
		<?php if(!empty($alumni)): foreach($alumni as $post): ?>
			<div class="col-lg-4">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h2><?php echo $post['nama_al']; ?></h2>
					</div>
				</div>
			</div>
		<?php endforeach; else: ?>
		<p>Alumni Tidak Ada.</p>
	<?php endif; ?>
	<div class="row">
		<?php echo $this->ajax_pagination->create_links(); ?>
	</div>
</div>
</section>