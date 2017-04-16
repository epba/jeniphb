<br>
    <ul data-role="listview" data-filter="true" data-input="#myFilter" data-autodividers="true" data-inset="true">
    <?php
      for($i=0;$i<$jlh;$i++){
        ?> 
     <br>
      <li data-icon="false"><a href="<?php echo base_url('mob_tampil/profil/').$id_al[$i];?>"><?php echo $nama_al[$i] ?></a></li>
        <?php
       }
       ?>
    </ul>
  
 <!-- page-->  
</div>