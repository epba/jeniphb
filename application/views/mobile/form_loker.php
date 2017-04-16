<?php
$uri = $this->uri->segment(3);
if ($uri == "edit" || $uri == "act_edit") {
  $act    = "act_edit";
  $uri_edit = "/$row->id_lok";
  $ket = 'Edit ';

} else {

  $act    = "act_post";
  $ket = '';
  $uri_edit = null;
  $row = new stdClass();
  $row->tmp_lok = "";
  $row->judul_lok = "";
  $row->isi_lok = "";
  $row->foto_lok = "";
  $row->alamat_lok = "";
  $row->time_end_lok = "";
  $row->lng_lok = "";
  $row->lat_lok = "";
  $row->kota_lok = "";

}

?>


<script type="text/javascript">
  var centreGot = false;
</script>

<?php echo form_open_multipart('mob_tampil/loker/'.$act.$uri_edit,array('data-ajax'=>'false')); ?>
<div style="padding:10px 10px;">
  <h3>Form <?=$ket?>Post A Job</h3>
  <input name="tempat" placeholder="Perusahaan PT" type="text" value="<?=$row->tmp_lok?>"  required > 
  <input name="jdl" placeholder="judul"  type="text" value="<?=$row->judul_lok?>" required>
  <textarea name="isi" placeholder="isi loker"  type="text" required><?=$row->isi_lok?></textarea>
  <label for="gbr">Gambar:</label>
  <input  name="gambar" id="gbr" type="file" value="<?=$row->foto_lok?>" required>
  <textarea name="alamat"  placeholder="alamat lengkap"  type="text"><?=$row->alamat_lok?></textarea>
  <input type="text" id="tgl" placeholder="berlaku hingga" name="time_end" value="<?=$row->time_end_lok?>" required>
  <input name="lat" placeholder="latitude" id="lat"  type="text" value="<?=$row->lat_lok?>" required>
  <input name="lng" placeholder="longitude" id ="lng" type="text" value="<?=$row->lng_lok?>" required>
  <input name="kota" placeholder="kota" id ="kota" type="text" value="<?=$row->kota_lok?>" >

  <div> <?= $map['html']; ?> </div>
  <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ">Post</button>

</div>
<?php echo form_close();?>
<?php echo $map['js']; ?> 

<!-- <script>
  $(document).ready(function() {
    $("#lat").change(function() {

      var baseurl = "<?php print base_url(); ?>";
      $.ajax({
        type: "POST",
        url: baseurl+"mob_tampil/get_lokasi/"+$("#lat").val()+"/"+$("#lng").val(),
        dataType: "text",  
        cache:false,
        data: $("#lat").serialize(),
        success: function(data) {
          $("#kota").html(data);
        }
      });

    });
  });
</script>  -->
<script type="text/javascript">
  $(document).ready(function(){  
    $('#lat, #lng').on('change', function(){
      var d1=$('#lat').val();
      var d2=$('#lng').val();
       var baseurl = '<?php print base_url(); ?>';
      $.ajax({
        url: baseurl+'mob_tampil/get_lokasi'+'/'+d1+'/'+d2,
        type : 'GET',
        cache:false,
        success: function(data) {
          $('#kota').val(data);
        }
      });
    });
  });


</script>