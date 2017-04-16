<input type="hidden" id="id_al" value="<?php echo $id_al; ?>" />
<input type="hidden" id="id_max" value="<?php echo isset($id_max) ? $id_max : '' ; ?>" />

<?php if($id_al > 0) { ?>
<?php if($chat->num_rows() > 0) { ?>	
<?php foreach($chat->result() as $row) { ?>
<?php if($row->send_by == $this->session->userdata('login')['id_al']) { ?>
<div class="col-md-12">
	<div class="panel panel-default panel-comment pull-right">
		<div class="panel-heading" >
			<b>Anda :</b><small class="pull-right" style="color:grey;margin-top:0px;"><?php echo date("d-M-Y H:i:s", strtotime($row->time)); ?></small><br/>
			<?php echo $row->message; ?>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="col-md-12">
	<div class="panel panel-default panel-comment" style="background-color: #0D47A1  !important;">
		<div class="panel-heading" >
			<?php $user		= $this->model_user->getAll(array("id_al" => $id_al))->row_array(); ?>
			<b> <?php echo $user['nama_al']?> : </b><small class="pull-right" style="color:grey;margin-top:0px;"><?php echo date("d-M-Y H:i:s", strtotime($row->time)); ?></small></br>
			<?php echo $row->message; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php } ?>
<?php }else{ ?>

<?php } ?>
<?php } else { echo "<h2>Chatt with $nama_al; </h2>"; } ?>