	<?php echo validation_errors('<div class="error">', '</div>'); ?>
	<?php echo form_open(base_url('mob_tampil/profil/act_edit_password'), array('data-ajax'=>'false')); ?>
	
	<?php echo $this->session->flashdata("k") ;?>
	<br>
	<label><b>Old Password</b></label>
	<input type="password" name="old_password" placeholder="Current Password:">
	<label style="float: left"><b>New Password</b></label>
	<br>
	<input type="password" name="newpassword" placeholder="New Password: " id="Pswd" >
	<label style="float: left"><b>Retype Password</b></label>
	<br>
	<input type="password" name="re_password" placeholder="Retype New Password: " id="cPswd" >
	<br>
	<input  type="submit" data-theme="b" value="Update">

	<?php echo form_close(); ?>
