<input type="hidden" id="id_al" value="<?php echo $id_al; ?>" />
<input type="hidden" id="id_max" value="<?php echo isset($id_max) ? $id_max : '' ; ?>" />

<?php if($id_al > 0) { ?>
<?php if($chat->num_rows() > 0) { ?>	
<?php foreach($chat->result() as $row) { ?>
<?php if($row->send_by == $this->session->userdata('login')['id_al']) { ?>

<div class="panel panel-default panel-comment pull-right"  style="background-color:#E6E2E2 ; ">
	<div class="panel-heading" align="right" style="background-color:#E6E2E2 ; border-right:6px solid red;  " >
		<b>YOU</b>
		<p style="border: 0px;  border-bottom: 1px; border-style: outset; border-color: blue; "></p>
		<small class="pull-right" style="color:grey;margin-top:0px;"><?php echo date("d-M-Y H:i", strtotime($row->time)); ?></small>
		<br>
		<?php echo $row->message; ?>
	</div>
</div>




<br><br> <br> <br><br> <br> <br>

<?php } else { ?>
<!-- <div class="col-md-4"> -->

<div class="panel panel-default panel-comment" style="background-color: #0D47A1  !important;">
	<div class="panel-heading" style="border-left:6px solid blue;">
		<?php 
		$user		= $this->model_user->getAll(array("id_al" => $id_al))->row_array(); 
		$a =  $user['nama_al'];
		$arr = explode(' ',trim($a));
		$nama = $arr[0];

		$w = $this->session->all_userdata('login')['login']['id_al'];

		?>



		<b style="text-transform: uppercase;"><?php echo $nama?></b> <p style="border: 0px;  border-bottom: 1px; border-style: outset; border-color: blue; "></p>
		<small class="pull-right" style="color:grey;margin-top:0px;"><?php echo date("d-M-Y H:i", strtotime($row->time)); ?></small></br>
		<?php echo $row->message; ?>
	</div>
</div>
<br>

<!-- </div> -->
<?php } ?>
<?php } ?>
<?php }else{ ?>
<?php } ?>
<?php } else { echo "<h2>Chat with $user->nama_al; </h2>"; } ?>

