<?php 
if(!empty($alumni)): foreach($alumni as $post): ?>
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