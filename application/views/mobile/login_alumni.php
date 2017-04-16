<?php echo $this->session->flashdata("k");?>

 <br>

 <?php echo form_open('login/proses',array('data-ajax'=>'false'));?>
 <input type="text" name="username" id="username" size="30" class="input-teks" placeholder="Username"  />           
 <br>
 <input type="password" name="password" size="30" class="input-teks" placeholder="Password" />
 <br>
 <center><input type="submit" class="ui-btn-b" value="Sign In" data-inline="true"/> </center>

 <?php echo form_close(); ?>



