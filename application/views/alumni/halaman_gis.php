<?php echo $map['js']; ?>
<?php echo $map['html']; ?>

<table class="table" id="myTable">
  <thead>
    <tr>
      <th data-priority="2">No.</th>
      <th>Kota</th>
      <th data-priority="1">Jumlah Tinggal</th>
      <th data-priority="3">Bekerja</th>

    </tr>
  </thead>
  <tbody>
   <?php 
   $no = 1;
   foreach ($kota as $index => $key) { ?>
   <tr>
     <td><?=$no++?></td>
     <td><?=$key->kota_al?></td>
     <td><?=$key->jmlh?></td>
     <td>
     <?php if (empty($jmlh[$index]->kerja)) {
         echo "0";
       }
       else{
        echo $jmlh[$index]->kerja;
      }
      ?>

    </td>
  </tr>
  <?php } ?>

  <tr>
   <td colspan="2"  align="right"><b>Total</b></td>
   <td><?= $jm_jmlh?></td>
   <td><?= $jm_kota?></td>


 </tr>
</tbody>
</table>
