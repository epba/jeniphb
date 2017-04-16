<html>
<head>

  <?php echo $map['js']; ?>
  <style>
    th {
      border-bottom: 1px solid #d6d6d6;
    }

    tr:nth-child(even) {
      background: #e9e9e9;
    }
  </style>
</head>
<body><?php echo $map['html']; ?>
	
	<br>
	<br>
	<table data-role="table" data-mode="columntoggle" class="ui-responsive" id="myTable">
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
       <td><?=$jmlh[$index]->kerja?></td>
     </tr>
     <?php } ?>

     <tr>
     <td colspan="2"  align="right"><b>Total</b></td>
      <td><?= $jm_jmlh?></td>
      <td><?= $jm_kota?></td>

      
    </tr>
  </tbody>
</table>
</body>
</html>