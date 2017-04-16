<script type="text/javascript">
    function hideshow(which){
        if (!document.getElementById)
            return
        if (which.style.display=="inline")
            which.style.display="none"
        else
            which.style.display="inline"
    }
</script>

<?php echo $map['js']; ?>


<div data-role="popup" id="popupParis" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <img class="popphoto"  id="besar" src="<?=base_URL()?>assets/upload/alumni/<?php echo $alumni[0]['foto_al']; ?>"  alt="Profil photo">
</div>

<ul data-role="listview" data-inset="true"  data-theme="c" style="margin:0px;">
 <li style=" background-image: url('<?=base_URL('assets/back.jpg')?>');
    background-repeat: repeat-x;">
    <center>
        <a href="#popupParis" data-rel="popup" data-position-to="window" data-transition="fade">
            <img width='70px' height="70px" class="popphoto" src="<?=base_URL()?>assets/upload/alumni/<?php echo $alumni[0]['foto_al']; ?>" style="margin-top:20px; margin-left:30px;border-radius: 500px;">
        </a>
        <h2 style="color:white"><?php echo $alumni[0]['nama_al'];?></h2>
        "<?php echo $status[0]['isi_feed'] ;?>"
    </center>
    <?php 
    $go_ed = $this->uri->segment(3);
    if ($go_ed == $this->session->userdata('login')['id_al'] ) {
        ?>
        <center>
            <a href="<?php echo base_url('mob_tampil/profil/edit/').$alumni[0]['id_al'];?>" data-theme="b"> Perbaharui Profil</a>
        </center>
        <?php } 
        else {
            ?>

            <center> <p><a href="<?php echo base_url('mob_tampil/pesan/').$alumni[0]['id_al'];?>">Chat With <?=$alumni[0]['nama_al'];?></a></p></center>

            <?php }  ?>


            <?php echo $this->session->flashdata("k");?>

        </li>

      <!--   <li>
         <button type="submit" style="border: 0; background: transparent">
            <img src="<?=base_URL()?>assets/upload/alumni/<?php echo $alumni[0]['foto_al']; ?>" width="90" height="50" alt="submit" />
        </button>

    </li>  -->
    <li>
        <label style="float: left"><b>Nama Lengkap</b></label><br>
        <input  type="text" name="nama"  value="<?php echo $alumni[0]['nama_al']; ?>" readonly>


    </li>
    <li>
        <label style="float: left"><b>Alamat</b></label><br>
        <textarea type="text" name="alamat" readonly><?php echo $alumni[0]['alamat_al'] ;?></textarea>
    </li>
    <li data-icon="false" style="padding: .7em 15px;">
        <label style="float: left; text-shadow: none; font-size:12px;"><b style="color: #59586D;">Phone</b></label><br>
        <a href="tel:<?php echo $alumni[0]['cp_al'] ;?>"><input type="tel" name="phone" pattern="[0-9]*" value="<?php echo $alumni[0]['cp_al'] ;?>" readonly></a>
    </li>
    <li data-icon="false" style="padding: .7em 15px;">
        <label style="float: left; text-shadow: none; font-size:12px;" ><b style="color: #59586D;">E-mail</b></label><br>
        <a href="mailto:<?php echo $alumni[0]['email_al'];?>"><input  type="email" name="email" value="<?php echo $alumni[0]['email_al'];?>" readonly></a>
    </li>
    <?php
    if ($alumni[0]['alker_al']==null) {

    } else {?>
    <li> <label style='float: left'><b>Alamat Bekerja</b></label><br>
        <input  type='text' name='kerja'  value='<?=$alumni[0]['alker_al']?>' readonly>
    </li>
    <?php
}

?>


</li>
</ul>

<?php echo $map['html']; ?>
<div id="directionsDiv"></div>

</div>
<!-- page  
 -->