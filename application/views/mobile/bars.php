    <ul data-role="listview"  id="listview" data-theme="d" data-divider-theme="d" class="ui-corner" style="margin:0px;" data-inset="true">
      <li data-icon="false">
        <a href="<?php echo base_url('mob_tampil/profil/').$aku->id_al;?>"  data-ajax="false" data-transition="flip">
          <img class="ui-li-thumb" style="height: 100px; width: 60px;" src="<?php echo base_url('assets/upload/alumni/').$aku->foto_al;?>" style="padding-top:20px; padding-left:20px; ">
          <h2> <?php echo $aku->nama_al ;?></h2>
          <p>lihat profil anda</p>
        </a>
      </li>
      <li data-role="list-divider" style="border-radius: 0px">Institusi</li>
      <li data-icon="false">
        <a href="<?php echo base_url('mob_tampil/sekolah/').$skl->id_sklh;?>" data-transition="fade">
          <img class="ui-li-thumb" src="<?php echo base_url('assets/upload/sekolah/').$skl->logo_sklh?>" style="padding-top:20px; padding-left:35px;height:40px">
          <h2> <?php echo $skl->nama_sklh;  ?></h2>
          <p>lihat profil instansi anda</p>
        </a>
      </li>
      <li data-icon="false">
        <a href="<?php echo base_url('mob_tampil/grup/member/').$skl->id_sklh;?>"  data-transition="pop">

          <b  class="fa fa-group fa-1x" aria-hidden="true" style=" padding-left:30px;"></b>
          <label style="padding-left:35px;">Teman Grup</label>

        </a>
      </li>
      
      <li data-icon="false">
        <a href="<?php echo base_url('mob_tampil/tracer');?>" data-ajax="false" data-transition="pop">
         <b  class="fa fa-map-marker fa-1x" aria-hidden="true" style="padding-left:34px;"> 
         </b>
        <label style="padding-left:37px;">Track Alumni</label>
       </a>
     </li>

     <li data-icon="false">
      <a href="<?php echo base_url('mob_tampil/grup/agenda/').$skl->id_sklh;?>" data-transition="pop">

        <b  class="fa fa-calendar fa-1x" aria-hidden="true" style=" padding-left:30px;"> 
        </b>
       <label style="padding-left:38px;">Agenda</label>

      </a>
    </li>
    <li data-role="list-divider" style="border-radius:0">Akunku</li>

    <li data-icon="false">
      <a href="<?php echo base_url('mob_tampil/profil/edit/').$aku->id_al;?>"  data-transition="pop">
        <b  class="fa fa-user fa-1x" aria-hidden="true" style=" padding-left:30px;"> 
        </b>
       <label style="padding-left:40px;">Edit Profil</label>

      </a>
    </li> 
    <li data-icon="false">
      <a href="<?php echo base_url('mob_tampil/profil/edit_password/').$aku->id_al;?>"  data-transition="flip">
        <b  class="fa fa-key fa-1x" aria-hidden="true" style=" padding-left:30px;"> 
        </b>
       <label style="padding-left:34px;">Change Password</label>

      </a>
    </li>

    <li data-icon="false">
      <a href="#"  data-transition="slidedown">
       <b class="fa fa-question fa-1x" aria-hidden="true" style=" padding-left:30px;"> 
       </b>
      <label style="padding-left:40px;">Help</label>

     </a>
   </li>
   <li data-icon="false">
    <a href="<?php echo base_url('login/logout');?>"  data-transition="none" >


      <b  class="fa fa-sign-out fa-1x" aria-hidden="true" style=" padding-left:30px;"> 
      </b>
     <label style="padding-left:35px;"> Log Out</label>
      
    </a>
  </li> 

</ul>

