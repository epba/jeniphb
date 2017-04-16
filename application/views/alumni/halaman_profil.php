<script type="text/javascript">
  var centreGot = false;
</script>
<section id="content">
  <div class="container">
    <?php echo $this->session->flashdata('notifikasi'); ?>
    <div class="row text-center">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-4">
        <h2>
          <span>
            <?php echo $profil->nama_al; ?>
          </span>
          <br>
          <small>
            <?php echo $asal_sekolah->nama_sklh; ?>
          </small>
        </h2>
        <p>
          <?php if (!empty($profil->foto_al)) { ?>
          <img src="<?php echo base_url().'assets/upload/alumni/'.$profil->foto_al; ?>" style="border-radius: 50%;">
          <?php } else { ?>
          <img src="<?php echo base_url().'assets/upload/alumni/default_profil.jpg'; ?>" style="border-radius: 50%;max-height: 150px">
          <?php } ?>
        </p>
      </div>
      <div class="col-lg-4">
        <div class="col-lg-12">
          <h4>
            Alamat Rumah
          </h4>
          <span class="pullquote-right">
           <?php 
           if (empty($profil->alamat_al)) { echo "Belum Diisi"; }
           else { echo $profil->alamat_al; } 
           ?>
         </span>
       </div>
       <div class="col-lg-12">
        <h4>
          Email
        </h4>
        <span class="pullquote-right">
         <?php if (empty($profil->email_al)) { echo "Belum Diisi"; } else { echo $profil->email_al; } ?>
       </span>
     </div>
     <div class="col-lg-12">
      <h4>Telp.</h4>
      <span class="pullquote-right">
        <?php if (empty($profil->cp_al)) { echo "Belum Diisi"; } else { echo $profil->cp_al; } ?>
      </span>
    </div>
    <div class="col-lg-12">
      <h4>
        Alamat Kerja
      </h4>
      <span class="pullquote-right">
       <?php  if (empty($profil->alker_al)) { echo "Belum Diisi"; } else { echo $profil->alker_al; } ?>
     </span>
   </div>
 </div>
 <div class="col-lg-2">
 </div>
</div>
</div>
</section>
<section class="callaction">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="cta-text">
          <h2>Belum update <span>profil</span> ? Buruan update....</h2>
          <p>Jangan bikin pusing temanmu dengan profil yang tidak update, OK!!</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="cta-btn">
          <a href="<?php echo base_url().'web_alumni/form_update_profil/'.$this->session->userdata('data_login_alumni')['id_al'];?>">
            <button class="btn btn-theme btn-lg" id="btn-update">Update Profil <i class="fa fa-angle-right"></i></button>
          </a>
        </div>
      </div>  
    </div>
  </div>
  <?php if (!empty($profil->lat_al)) {
    echo $map['js'];
    echo $map['html'];
  } ?>
</section>
