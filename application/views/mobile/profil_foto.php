<?php echo form_open_multipart('mob_tampil/profil/edit_foto',array('data-ajax'=>'false','type' => 'hidden')); ?>
<input type="file" name="filefoto" class="form-control">
<input type="submit" class="btn btn-success" value="Simpan">
<?php echo form_close();?> 