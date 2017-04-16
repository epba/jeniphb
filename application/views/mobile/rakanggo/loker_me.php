<?php
if ($loker_me === 0) {
 echo '<br><div class=\'error\'>tidak ada postingan tersedia</div>';
} else {
  foreach($loker_me as $val){
    $hsl = $val->time_end_lok;
    $date = date('Y-m-d');
    $status = $val->verifikasi_lok;
    
    if ($status == 1 && ($hsl >= $date)) {
      $sts = 'verified';
      $color ='';
      $edit = 'none';
    } else {
      $sts = 'not verified';
      $color ='background: #F95555';
      $edit ='';
    }
    
    ?>
    <div class="quote1 social" style="margin-top: 0px; margin-bottom: 3px; <?php echo $color;?>" >

      <a href="<?php echo base_url('mob_tampil/loker/view/').$val->id_lok ?>"  >
        <img class="ui-li-thumb" style="position: static; height: 50px; width: 180px;padding-top:20px;padding-left:10px;" src="<?php echo base_url('assets/upload/loker/').$val->foto_lok ?>">
        <h2 class="ui-li-heading" class="error"><?php echo $val->tmp_lok ?></h2>
        <p class="ui-li-desc" class="error"><?php echo $val->judul_lok ?></p>
        <p class="ui-li-desc" style="color: #888;"> <?php echo $val->time_lok ?>  </p></a>
        <p class="ui-li-desc" style="color: #5959ED; text-align: right;">  
          <label class="fa fa-user fa-1x">&nbsp;&nbsp;</label> <?php echo $sts ?> &nbsp; <?php echo $val->time_end_lok ?>  

        </p>
        <div style="text-align: right;">
          <a href="<?php echo base_url('mob_tampil/loker/edit/').$val->id_lok?>" type="button" style="display:<?=$edit?>"> <i class="fa fa-map-marker icon-retweet icon-border" aria-hidden="true"></i> Edit</a>
          <a href="<?php echo base_url('mob_tampil/loker/delete/').$val->id_lok?>" type="button" style="color: #F95555"> <i class="fa fa-close icon-border" aria-hidden="true" onclick="return confirm('Anda YAKIN menghapus postingan \n <?=$val->judul_lok?>..?');"></i> Delete</a>
        </div>

      </div>
      <?php
    }
  }
  ?>
  <center><p><?php echo $this->pagination->create_links();?> </p></center>


