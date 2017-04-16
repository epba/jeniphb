<?php echo $this->session->flashdata('notifikasi'); ?>
<?php echo form_open(base_url()."web_sekolah/form_ganti_password/proses_ganti_password/",array('id' => 'gan_pas')); ?>
<div class="box box-body">
  <div class="form-group">
    <label for="exampleInputEmail1">Password Lama</label>
    <input type="password" placeholder="Password"  class="form-control" required name="pass_lama">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password Baru</label>
    <input class="form-control" id="password" placeholder="Password" type="password" name="pass_baru">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Konfirmasi Password Baru</label>
    <input type="password" placeholder="Confirm Password"  class="form-control" id="confirm_password" required name="pass_konfir">
  </div>
  <div class="box-footer">
    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
