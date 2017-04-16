<?php
if (isset($row))
  {?>
<div class="team " style="margin-top: 0px; margin-bottom: 3px; text-align: center;" >

  <div data-role="popup" id="popupParis" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <img class="popphoto" id="besar" src="<?php echo base_url('assets/upload/loker/').$row->foto_lok ?>" alt="Profil photo">
  </div>
  <a href="#popupParis" data-rel="popup" data-position-to="window" data-transition="fade"> <img class="loker" style="" src="<?php echo base_url('assets/upload/loker/').$row->foto_lok ?>"></a>
  <h2 class="ui-li-heading"><?php echo $row->judul_lok ?></h2>
  <p class="ui-li-desc"><b style="color: red;"><i class="fa fa-calendar-times-o" aria-hidden="true"></i>
 <?php echo date("l, j F Y", strtotime("{$row->time_end_lok}"));?></b> </p>
  <p><?php echo $row->tmp_lok ?></p>
  <p>Lokasi &nbsp;<?php echo $row->alamat_lok ?> </p> 
  <p>
    <a href="<?php echo base_url('mob_tampil/loker/track/').$row->id_lok?>" type="button"> <i class="fa fa-map-marker icon-border" aria-hidden="true"> </i></a>
    <?php 
    $id = $this->session->userdata('login')['id_al'];
    if ($row->id_pengirim_lok != $id) { ?>
    <a href="<?php echo base_url('mob_tampil/pesan/').$row->id_pengirim_lok;?>" type="button"> <i class="fa fa-comments icon-border" aria-hidden="true"></i></a>
    <?php } ?>

</p>
<hr> 
<p><?php echo $row->isi_lok ?></p>

<p class="ui-li-desc" style="color: #888; text-align: right;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("l, j F Y", strtotime("{$row->time_lok}"));?>
</p>
<p class="ui-li-desc" style="color: #5959ED; text-align: right;">
  <label class="fa fa-user fa-1x">&nbsp;&nbsp;</label>
  <?php echo $row->id_pengirim_lok ?> 
</p>

</div>



<?php }?>
