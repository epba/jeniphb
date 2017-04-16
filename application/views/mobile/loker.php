<?php 
$kerja = $alumni[0]['alker_al'];
if ($kerja == NULL) {
} else {?>
<div class="alist">
  <div class="thumbnail-list">
    <ul  data-role="listview" data-filter-theme="f" data-inset="true" style="margin:0px;">
     <li>
      <div class="ui-btn-inner ui-li" aria-hidden="true" >
        <div class="ui-btn-text"> 
          <a  href="<?php echo base_url('mob_tampil/loker/post')?>" class="ui-link-inherit" data-ajax="false">
            <img class="ui-li-thumb" style="height: 70px; width: 70px;" src="<?php echo base_url('assets/upload/alumni/').$alumni[0]['foto_al']?>" >
            <p style="padding-top:20px; font-size: 13px"> Click To Post A Job Here</p>
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>
<?php } ?>
<?php 
$id = $this->session->userdata('login')['id_al'];
$sql = $this->db->get_where('loker', array('id_pengirim_lok' => $id))->num_rows();
if ($sql === 0) { } else { ?>

<div data-role="navbar" class="navbar" data-grid="a">
  <ul>
    <li><a href="#all" data-theme="a" onclick="document.getElementById('all').style.display=''; document.getElementById('me').style.display='none' ;" class="tab ui-btn-active">All Post</a></li>

    <li><a href="#me" data-theme="a" class="tab" onclick="document.getElementById('me').style.display='';document.getElementById('all').style.display='none';">My Post</a></li>
    
  </ul>
</div>
<?php }  ?>
<div id="all" style="display: block" >
  <?php
  if ($loker === 0) {
   echo '<br><div class=\'error\'>tidak ada postingan tersedia</div>';
 } else {
/*  $this->db->select('perusahaan.nama_per,sekolah.nama_sklh,alumni.nama_al');
  $this->db->join('perusahaan', 'loker.id_pengirim_lok = perusahaan.username_per', 'right');
  $this->db->join('sekolah', 'loker.id_pengirim_lok = sekolah.username_sklh', 'right');
  $this->db->join('alumni', 'loker.id_pengirim_lok = alumni.username_al', 'right');
  $this->db->or_where('loker.id_pengirim_lok', 'perusahaan.username_per');
  $this->db->or_where('loker.id_pengirim_lok', 'sekolah.username_sklh');
  $this->db->or_where('loker.id_pengirim_lok', 'alumni.username_al');
  $try = $this->db->get_where('loker', array('id_lok' => 31 ))->result(); 
 var_dump($try);
 exit;*/
 foreach($loker as $index =>$val) { ?> 
 <div class="quote1 social" style="margin-top: 0px; margin-bottom: 3px;">
  <a href="<?php echo base_url('mob_tampil/loker/view/').$val->id_lok?>" >
    <img class="ui-li-thumb" style="position: static; height: 50px; width: 180px;padding-top:20px;padding-left:10px;" src="<?php echo base_url('assets/upload/loker/').$val->foto_lok ?>">
    <h2 class="ui-li-heading"><?php echo $val->judul_lok?></h2>
    <p class="ui-li-desc"><?php echo $val->tmp_lok?></p>
    <p class="ui-li-desc" style="color: #888;"><i class="fa fa-calendar" aria-hidden="true"></i>
      <?php echo date("l, j F Y", strtotime("{$val->time_lok}"));?></p>
      <p class="ui-li-desc" style="color: #5959ED; text-align: right;">


        <label class="fa fa-user fa-1x">&nbsp;&nbsp;</label> <?=$val->id_pengirim_lok;?>  </p>
      </a>
    </div>
    <?php   }  }  ?>
    <center><p><?php echo $this->pagination->create_links();?> </p></center>

  </div>

  <div id="me" style="display: none">
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
        $color ='background: #ffcdd2';
        $edit ='';
      }

      ?>
      <div class="quote1 social" style="margin-top: 0px; margin-bottom: 3px; <?php echo $color;?>" >

        <a href="<?php echo base_url('mob_tampil/loker/view/').$val->id_lok ?>"  >
          <img class="ui-li-thumb" style="position: static; height: 50px; width: 180px;padding-top:20px;padding-left:10px;" src="<?php echo base_url('assets/upload/loker/').$val->foto_lok ?>">
          <h2 class="ui-li-heading" class="error"><?php echo $val->tmp_lok ?></h2>
          <p class="ui-li-desc" class="error"><?php echo $val->judul_lok ?></p>
          <p class="ui-li-desc" style="color: #888;"><?php echo date("l, j F Y", strtotime("{$val->time_lok}"));?></p></a>
          <p class="ui-li-desc" style="color: #5959ED; text-align: right;">  
            <label class="fa fa-user fa-1x">&nbsp;&nbsp;</label><?php echo $sts?> &nbsp; <?php echo date("l, j F Y", strtotime("{$val->time_end_lok}"));?>

          </p>
          <div style="text-align: right;">
            <a href="<?php echo base_url('mob_tampil/loker/edit/').$val->id_lok?>" type="button" style="display:<?=$edit?>"> <i class="fa fa-pencil icon-border" aria-hidden="true" data-ajax="false"></i></a>
            <a href="<?php echo base_url('mob_tampil/loker/delete/').$val->id_lok?>" data-ajax="false" type="button" style="color: #F95555"> <i class="fa fa-close icon-border" aria-hidden="true" onclick="return confirm('Anda YAKIN menghapus postingan \n <?=$val->judul_lok?>..?');"></i></a>
          </div>

        </div>
        <?php
      }
    }
    ?>
    <center><p><?php echo $this->pagination->create_links();?> </p></center>



  </div>