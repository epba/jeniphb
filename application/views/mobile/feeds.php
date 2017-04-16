<div class="alist">
  <div class="thumbnail-list">
    <ul  data-role="listview" data-filter-theme="f" data-inset="true" style="margin:0px;padding: 0px;">
     <li>
      <div class="ui-btn-inner ui-li" aria-hidden="true" >
        <div class="ui-btn-text"> 
          <a class="ui-link-inherit " href="#popupadd" data-theme="b" data-rel="popup" data-transition="turn" data-position-to="window" data-transition="fade">
            <img class="ui-li-thumb" style="height: 100px; width: 100px;" src="<?php echo base_url('assets/upload/alumni/'). $row->foto_al?>" >
             <textarea name="isi" class="ui-li-desc"> <?php echo $row->isi_feed;?></textarea>
                  </a>
        </div>

      </li>
    </ul>
  </div>
</div>

<div data-role="popup" id="popupadd" data-theme="b" class="ui-corner-all">
<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
   <?php echo form_open('mob_tampil/index/update',array('data-ajax'=>'false')); ?>
        <div style="padding:10px 20px;">
            <h3>Change Your Status</h3>
            <textarea name="isi"><?php echo $row->isi_feed;?></textarea>
            <input type="submit"  value="Update"/>
        </div>
    <?php echo form_close();?>
</div>




<!-- list begins -->
<div class="alist" style="margin-bottom:2px; ">
  <div class="thumbnail-list">
    <ul  data-inset="true" data-role="listview" data-filter-theme="f">
      <?php 
      if (count($feeds) === 0) {
       echo '<div class=\'error\'>tidak ada feeds </div>';
     } else {
      foreach($feeds as $val) { ?>   
      <li class="ui-btn-icon-right" data-icon="false">
        <div class="ui-btn-inner ui-li" aria-hidden="true">
          <div class="ui-btn-text"> 
            <a class="ui-link-inherit" href="<?php echo base_url('mob_tampil/profil/').$val->id_al?>" data-ajax="false">
             <img class="ui-li-thumb" style="
             width:  50px;
             height: 50px;
             " src="<?php echo base_url('assets/upload/alumni/').$val->foto_al;?>" >
             <h3 class="ui-li-heading" style="color: #2a5d84;"><?php echo $val->nama_al ?></h3>
             <p class="ui-li-desc" style="color: #888;"><?php echo $val->time_feed ?></p>
             <p  style="margin-left: -100px;"><b><?php echo $val->isi_feed ?> </b></p>
           </a>                
         </div>
         <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span> </div>
       </li>
       <?php  } } ?>
       

     </ul>

   </div>
   <!-- list ends -->
 </div>

   <center><p><?php echo $this->pagination->create_links();?> </p></center>



